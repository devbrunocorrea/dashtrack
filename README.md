# DashTrack

[![Laravel Tests](https://github.com/devbrunocorrea/dashtrack/actions/workflows/laravel-tests.yaml/badge.svg?branch=main)](https://github.com/devbrunocorrea/dashtrack/actions/workflows/laravel-tests.yaml)

O sistema permite a visualização de indicadores com dados do TinyERP.

## Tecnologias:
- [x] PHP
- [x] Laravel
- [x] Laravel Breeze
- [x] OpenAPI (L5-Swagger)
- [x] AdminLTE
- [x] Integração com TinyERP 
- [x] Docker (sem Laravel/Sail)
- [x] PHPMyAdmin 
- [x] Nginx

## Configuração:
```
TINYERP_ENDPOINT=https://api.tiny.com.br/api2
TINYERP_TOKEN=TOKEN
```

## Execução Inicial:
```
./setup
```

## Para execução:
```
./stop
```

## Iniciar novamente:
```
./start
```

## Testes:
```
php artisan test
```

## Acesso:
http://127.0.0.1:8080

## API
http://127.0.0.1:8080/api

## Documentação da API - OpenAPI (Swagger)
http://127.0.0.1:8080/api/documentation

## PHPMyAdmin:
http://127.0.0.1:8081
* Login: `root`
* Senha: `root`

### Principais rotas:
- /api
- /api/documentation
- /register
- /login
- /logout
- /dashboard
- /dashboard/settings

### Commands:
```bash
php artisan dashtrack:check
```
