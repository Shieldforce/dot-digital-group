<?php

namespace Src\Core\Security;

use Carbon\Carbon;
use Src\Database\TypeDatabaseInterface;
use Src\Exception\DdosException;
use Src\Exception\IpNotFoundException;
use function Symfony\Component\Clock\now;

class Ip
{
    protected $connect;
    protected $key = "clientKeyMonitor";

    public function __construct(
        public string $ip,
        protected TypeDatabaseInterface $database
    )
    {
        if (empty($this->ip)) {
            IpNotFoundException::error('Ip not found!');
        }

        $this->connect = $this->database->connect();

        $this->reset();

        $this->lockByBlock();

        $this->setIp();

        $this->verifyIp();
    }

    protected function setIp()
    {
        $count = 1;
        $date  = Carbon::now()->format('Y-m-d H:i');

        if ($get = $this->connect->read($this->key)) {
            $separe = explode("|", $get);
            $count  = (int)$separe[1] + 1;
        }

        $this->connect->create(
            $this->key, "{$this->ip}|{$count}|{$date}"
        );
    }

    protected function verifyIp()
    {
        $get    = $this->connect->read($this->key);
        $separe = explode("|", $get);
        $date   = Carbon::createFromFormat("Y-m-d H:i", $separe[2]);

        $this->lockByRequest($separe, $date);

        return $get;
    }

    protected function lockByRequest($separe, Carbon $date)
    {
        if (
            $separe[1] > env("COUNT_REQUEST") &&
            $date->format("i") == Carbon::now()->format("i")
        ) {
            $this->connect->delete($this->key);

            $date = Carbon::now();
            $this->connect->create(
                $this->key, "block|0|{$date->format('Y-m-d H:i')}"
            );

            DdosException::error(
                "Many access to this ip!"
            );
        }
    }

    protected function lockByBlock()
    {
        $get = $this->connect->read($this->key);

        if (isset($get) && str_contains($get, "block")) {
            $explode = explode("|", $get);

            $date      = Carbon::createFromFormat("Y-m-d H:i", $explode[2]);
            $dateBlock = $date->addMinutes(
                (int)env("MINUTES_UNLOCK")
            )->format('Y-m-d H:i');

            DdosException::error(
                "Many access to this ip! Unlock: {$dateBlock}"
            );
        }
    }

    protected function reset()
    {
        $get     = $this->connect->read($this->key);
        $explode = explode("|", $get);
        $date    = Carbon::createFromFormat("Y-m-d H:i", $explode[2]);

        if (
            isset($get) &&
            str_contains($get, "block") &&
            $date->diffInMinutes(now()) > (int)env("MINUTES_UNLOCK")
        ) {
            $this->connect->delete($this->key);
        }
    }
}