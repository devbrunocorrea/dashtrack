<?php

namespace App\Services\TinyERP;

use App\Services\MetricServiceInterface;
use Illuminate\Support\Facades\Http;

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

    private function get(string $resource)
    {
        $endpoint = sprintf('%s/%s', $this->getEndpoint(), $resource);
        $response = Http::get($endpoint, [
            'token' => $this->getToken(),
        ]);


        $xml = simplexml_load_string($response->getBody());
        $json = json_encode($xml);

        return json_decode($json, true);
    }

    private function getEntidadePesquisa(string $entidade): array
    {
        return $this->get(sprintf('%s.pesquisa.php', $entidade));
    }

    public function getInfo(): array
    {
        return $this->get('info.php');
    }

    public function getItems(): array
    {
        return $this->getEntidadePesquisa('produtos');
    }

    public function getOrders(): array
    {
        return $this->getEntidadePesquisa('pedidos');
    }

    public function getSellers(): array
    {
        return $this->getEntidadePesquisa('vendedores');
    }

    public function getInvoices(): array
    {
        return $this->getEntidadePesquisa('notas.fiscais');
    }

    public function getTags(): array
    {
        return $this->getEntidadePesquisa('tag');
    }

    public function getPriceList(): array
    {
        return $this->getEntidadePesquisa('listas.precos');
    }

    public function getContacts(): array
    {
        return $this->getEntidadePesquisa('contatos');
    }
    
}