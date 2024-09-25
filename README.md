# DashTrack
O sistema permite a visualização de indicadores com dados do TinyERP.

## Tecnologias:
- [x] PHP
- [x] Laravel
- [x] Laravel Breeze
- [x] OpenAPI (L5-Swagger)
- [x] AdminLTE
- [x] Integração com TinyERP 

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
- /login
- /logout
- /dashboard
- /dashboard/settings

### Commands:
```bash
php artisan dashtrack:check
```
