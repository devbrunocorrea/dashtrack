<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\MetricServiceInterface;
use App\Services\TinyERP\TinyERPService;
use Tests\CreatesApplication;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;

class TinyERPServiceTest extends TestCase
{
    use CreatesApplication;

    public function test_instance()
    {
        $service = $this->createApplication()->make(MetricServiceInterface::class);
        $this->assertInstanceOf(TinyERPService::class, $service);

        return $service;
    }

    /**
     * @depends test_instance
     */
    public function test_instance_config(TinyERPService $service)
    {
        $getEndpoint = new \ReflectionMethod(TinyERPService::class, 'getEndpoint');
        $getEndpoint->setAccessible(true);

        $getToken = new \ReflectionMethod(TinyERPService::class, 'getToken');
        $getToken->setAccessible(true);

        $this->assertSame('http://foobar', $getEndpoint->invoke($service));
        $this->assertSame('token-token', $getToken->invoke($service));
    }

    /**
     * @depends test_instance
     */
    public function test_generate_url(TinyERPService $service)
    {
        $generateURL = new \ReflectionMethod(TinyERPService::class, 'generateURL');
        $generateURL->setAccessible(true);

        $expected = 'http://foobar/foobar.resource';
        $resource = 'foobar.resource';
        $url = $generateURL->invoke($service, $resource);
        $this->assertSame($expected, $url);

        return [$service, $url];
    }

    /**
     * @depends test_instance
     */
    public function test_generate_search_resource(TinyERPService $service)
    {
        $generateSearchResourceByEntity = new \ReflectionMethod(TinyERPService::class, 'generateSearchResourceByEntity');
        $generateSearchResourceByEntity->setAccessible(true);

        $expected = 'foobar.resource.pesquisa.php';
        $resource = 'foobar.resource';
        $url = $generateSearchResourceByEntity->invoke($service, $resource);
        $this->assertSame($expected, $url);
    }

    /**
     * @depends test_instance
     */
    public function test_request_get(TinyERPService $service)
    {
        $json = '{
            "retorno": {
                "status_processamento": 3,
                "status": "OK",
                "pagina": 1,
                "numero_paginas": 1566,
                "pedidos": {
                    "pedido": {
                        "id": 999999999,
                        "numero": 222222,
                        "numero_ecommerce": "Lojas Americanas-333333333",
                        "data_pedido": "11/08/2022",
                        "data_prevista": "16/08/2022",
                        "nome": "Fulano da Silva",
                        "valor": 126.56,
                        "id_vendedor": 0,
                        "nome_vendedor": "",
                        "situacao": "Cancelado",
                        "codigo_rastreamento": "",
                        "url_rastreamento": ""
                    }
                }
            }
        }';

        $mockResponse = new Response(200, [], $json);
        Http::shouldReceive('get')
            ->once()
            ->andReturn($mockResponse);

        $requestGet = new \ReflectionMethod(TinyERPService::class, 'requestGet');
        $requestGet->setAccessible(true);

        $response = $requestGet->invoke($service, 'http://foobar.com');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($json, $response->getBody());

        return $service;
    }

    /**
     * @depends test_request_get
     */
    public function test_get(TinyERPService $service)
    {
        $json = '{
            "retorno": {
                "status_processamento": 3,
                "status": "OK",
                "pagina": 1,
                "numero_paginas": 1566,
                "pedidos": {
                    "pedido": {
                        "id": "999999999",
                        "numero": "222222",
                        "numero_ecommerce": "Lojas Americanas-333333333",
                        "data_pedido": "11/08/2022",
                        "data_prevista": "16/08/2022",
                        "nome": "Fulano da Silva",
                        "valor": 126.56,
                        "id_vendedor": 0,
                        "nome_vendedor": "",
                        "situacao": "Cancelado",
                        "codigo_rastreamento": "",
                        "url_rastreamento": ""
                    }
                }
            }
        }';

        $mockResponse = new Response(200, [], $json);
        Http::shouldReceive('get')
            ->once()
            ->andReturn($mockResponse);

        $get = new \ReflectionMethod(TinyERPService::class, 'get');
        $get->setAccessible(true);
        $orders = $get->invoke($service, 'pedidos');

        $expected = [
            "status_processamento" => 3,
            "status" => "OK",
            "pagina" => 1,
            "numero_paginas" => 1566,
            "pedidos" => [
                "pedido" =>
                [
                    "id" => "999999999",
                    "numero" => "222222",
                    "numero_ecommerce" => "Lojas Americanas-333333333",
                    "data_pedido" => "11/08/2022",
                    "data_prevista" => "16/08/2022",
                    "nome" => "Fulano da Silva",
                    "valor" => 126.56,
                    "id_vendedor" => 0,
                    "nome_vendedor" => '',
                    "situacao" => "Cancelado",
                    "codigo_rastreamento" => '',
                    "url_rastreamento" => '',
                ],
            ],
        ];

        $this->assertIsArray($orders);
        $this->assertSame($expected, $orders);
    }
}
