<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Services\MetricServiceInterface;

class MetricController extends Controller
{
    private MetricServiceInterface $metricService;

    public function __construct(MetricServiceInterface $metricService)
    {
        $this->metricService = $metricService;
    }

    private function getMetricService(): MetricServiceInterface
    {
        return $this->metricService;
    }

    public function getInfo(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getInfo());
    }

    public function getOrders(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getOrders());
    }

    public function getItems(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getItems());
    }

    public function getInvoices(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getInvoices());
    }

    public function getSellers(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getSellers());
    }
}
