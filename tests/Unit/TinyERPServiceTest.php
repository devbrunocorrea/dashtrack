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
    public function test_xml_to_json(TinyERPService $service)
    {
        $stringXMLToArray = new \ReflectionMethod(TinyERPService::class, 'stringXMLToArray');
        $stringXMLToArray->setAccessible(true);

        $expected = ['foo' => 'bar'];
        $xml = '<xml><foo>bar</foo></xml>';

        $this->assertSame($expected, $stringXMLToArray->invoke($service, $xml));

        $expected = [];
        $xml = '';
        $this->assertSame($expected, $stringXMLToArray->invoke($service, $xml));

        $xml = null;
        $this->assertSame($expected, $stringXMLToArray->invoke($service, $xml));
        
        $xml = false;
        $this->assertSame($expected, $stringXMLToArray->invoke($service, $xml));
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
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <retorno>
            <status_processamento>3</status_processamento>
            <status>OK</status>
            <pagina>1</pagina>
            <numero_paginas>1566</numero_paginas>
                <pedidos>
                    <pedido>
                        <id>919293603</id>
                        <numero>153120</numero>
                        <numero_ecommerce>Lojas Americanas-423600324</numero_ecommerce>
                        <data_pedido>11/08/2022</data_pedido>
                        <data_prevista>16/08/2022</data_prevista>
                        <nome>Fulano da Silva</nome><valor>126.56</valor>
                        <id_vendedor>0</id_vendedor>
                        <nome_vendedor></nome_vendedor>
                        <situacao>Cancelado</situacao>
                        <codigo_rastreamento></codigo_rastreamento>
                        <url_rastreamento></url_rastreamento>
                    </pedido>
                </pedidos>
        </retorno>';
        $xml = preg_replace('/>\s+</', '><', $xml);

        $mockResponse = new Response(200, [], $xml);
        Http::shouldReceive('get')
            ->once()
            ->andReturn($mockResponse);

        $requestGet = new \ReflectionMethod(TinyERPService::class, 'requestGet');
        $requestGet->setAccessible(true);

        $response = $requestGet->invoke($service, 'http://foobar.com');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($xml, $response->getBody());

        return $service;
    }

    /**
     * @depends test_request_get
     */
    public function test_get(TinyERPService $service)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <retorno>
            <status_processamento>3</status_processamento>
            <status>OK</status>
            <pagina>1</pagina>
            <numero_paginas>1566</numero_paginas>
                <pedidos>
                    <pedido>
                        <id>919293603</id>
                        <numero>153120</numero>
                        <numero_ecommerce>Lojas Americanas-423600324</numero_ecommerce>
                        <data_pedido>11/08/2022</data_pedido>
                        <data_prevista>16/08/2022</data_prevista>
                        <nome>Fulano da Silva</nome><valor>126.56</valor>
                        <id_vendedor>0</id_vendedor>
                        <nome_vendedor></nome_vendedor>
                        <situacao>Cancelado</situacao>
                        <codigo_rastreamento></codigo_rastreamento>
                        <url_rastreamento></url_rastreamento>
                    </pedido>
                </pedidos>
        </retorno>';
        $xml = preg_replace('/>\s+</', '><', $xml);

        $mockResponse = new Response(200, [], $xml);
        Http::shouldReceive('get')
            ->once()
            ->andReturn($mockResponse);

        $get = new \ReflectionMethod(TinyERPService::class, 'get');
        $get->setAccessible(true);
        $orders = $get->invoke($service, 'pedidos');

        $expected = [
            "status_processamento" => "3",
            "status" => "OK",
            "pagina" => "1",
            "numero_paginas" => "1566",
            "pedidos" => [
                "pedido" =>
                [
                    "id" => "919293603",
                    "numero" => "153120",
                    "numero_ecommerce" => "Lojas Americanas-423600324",
                    "data_pedido" => "11/08/2022",
                    "data_prevista" => "16/08/2022",
                    "nome" => "Fulano da Silva",
                    "valor" => "126.56",
                    "id_vendedor" => "0",
                    "nome_vendedor" => [],
                    "situacao" => "Cancelado",
                    "codigo_rastreamento" => [],
                    "url_rastreamento" => [],
                ],
            ],
        ];

        $this->assertIsArray($orders);
        $this->assertSame($expected, $orders);
    }
}
