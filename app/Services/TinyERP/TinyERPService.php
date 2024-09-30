<?php

namespace App\Services\TinyERP;

use App\Services\MetricServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class TinyERPService implements MetricServiceInterface
{
    private string $endpoint;
    private string $token;

    public const ENTITY_ORDER = 'pedidos';
    public const ENTITY_SELLER = 'vendedores';
    public const ENTITY_INVOICE = 'notas.fiscais';
    public const ENTITY_TAG = 'tag';
    public const ENTITY_PRICE_LIST = 'listas.precos';
    public const ENTITY_CONTACT = 'contatos';
    public const ENTITY_PRODUCT = 'contatos';

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

    private function requestGet($endpoint, array $params = [])
    {
        $params['token'] = $this->getToken();
        $params['formato'] = 'json';

        return Http::get($endpoint, $params);
    }

    private function get(string $resource, array $params = []): array
    {
        $endpoint = $this->generateURL($resource);

        $response = $this->requestGet($endpoint, $params);

        $array = json_decode($response->getBody(), true);

        if (!isset($array['retorno'])) {
            throw new \Exception('Falha ao obter retorno');
        }

        return $array['retorno'];
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

    public function getByEntity(string $entity): array
    {
        return $this->searchByEntity($entity);
    }

    public function getAllByEntity(string $entity)
    {
        $resource = $this->generateSearchResourceByEntity($entity);
        $page = 1;
        $totalPages = 1;
        while ($page <= $totalPages) {
            if (isset($response)) {
                $response['pagina'] = ++$page;
                $totalPages = $response['numero_paginas'];
            }

            $response = $this->get($resource, ['pagina' => $page]);

            foreach ($response[$entity] as $responseEntity) {
                yield current($responseEntity);
            }
        }
    }
}