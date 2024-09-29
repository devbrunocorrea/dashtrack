<?php

namespace App\Services\TinyERP;

use App\Services\MetricServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

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

    private function requestGet($endpoint, array $params = []): Response
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

    public function getItems(): array
    {
        return $this->searchByEntity('produtos');
    }

    public function getOrders(): array
    {
        return $this->searchByEntity('pedidos');
    }

    public function getAllOrders(): \Generator
    {
        $resource = $this->generateSearchResourceByEntity('pedidos');
        $page = 1;
        $totalPages = 1;
        while ($page <= $totalPages) {
            if (isset($response)) {
                $response['pagina'] = ++$page;
                $totalPages = $response['numero_paginas'];
            }

            $response = $this->get($resource, ['pagina' => $page]);

            foreach ($response['pedidos'] as $order) {
                yield $order['pedido'];
            }
        }
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