<?php

namespace App\Services\TinyERP;

use App\Services\MetricServiceInterface;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Response;

class TinyERPService implements MetricServiceInterface
{
    private string $endpoint;
    private string $token;

    public function __construct()
    {
        $this->endpoint = config('services.tinyerp.endpoint');
        $this->token = config('services.tinyerp.token');
    }

    private function getEndpoint(): string
    {
        return $this->endpoint;
    }

    private function getToken(): string
    {
        return $this->token;
    }

    private function generateURL(string $resource): string
    {
        return sprintf('%s/%s', $this->getEndpoint(), $resource);
    }

    private function stringXMLToArray(?string $stringXML): array
    {
        if (empty($stringXML)) {
            return [];
        }

        $xml = simplexml_load_string($stringXML);
        return json_decode(json_encode($xml), true);
    }

    private function requestGet($endpoint): Response
    {
        return Http::get($endpoint, [
            'token' => $this->getToken(),
        ]);
    }

    private function get(string $resource)
    {
        $endpoint = $this->generateURL($resource);

        $response = $this->requestGet($endpoint);

        $stringXML = $response->getBody();

        return $this->stringXMLToArray($stringXML);
    }

    private function generateSearchResourceByEntity(string $entity)
    {
        return sprintf('%s.pesquisa.php', $entity);
    }

    private function searchByEntity(string $entity): array
    {
        $searchResource = $this->generateSearchResourceByEntity($entity);

        return $this->get($searchResource);
    }

    public function getInfo(): array
    {
        return $this->get('info.php');
    }

    public function getItems(): array
    {
        return $this->searchByEntity('produtos');
    }

    public function getOrders(): array
    {
        return $this->searchByEntity('pedidos');
    }

    public function getSellers(): array
    {
        return $this->searchByEntity('vendedores');
    }

    public function getInvoices(): array
    {
        return $this->searchByEntity('notas.fiscais');
    }

    public function getTags(): array
    {
        return $this->searchByEntity('tag');
    }

    public function getPriceList(): array
    {
        return $this->searchByEntity('listas.precos');
    }

    public function getContacts(): array
    {
        return $this->searchByEntity('contatos');
    }
    
}