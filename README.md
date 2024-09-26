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

## Execução via Docker:
```
docker-compose up
```

## Testes:
```
php artisan test
```

## Acesso:
http://127.0.0.1:8123

## API
http://127.0.0.1:8123/api

## Documentação da API - OpenAPI (Swagger)
http://127.0.0.1:8123/api/documentation

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
