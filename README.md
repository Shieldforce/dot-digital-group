# Dot Digital Group

### Iniciar Projeto

## Usando Scoob
```
scoob --type docker-php-nginx --version 8.3 --port 8007
```

## Rodar comandos no container
```
docker exec -it php-fpm-8.3-8007 {comando}
```
## Atualizar NameSpaces
```
docker exec -it php-fpm-8.3-8007 composer dump-autoload
```