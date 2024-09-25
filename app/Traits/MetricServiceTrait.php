<?php

namespace App\Traits;

use App\Services\MetricServiceInterface;

trait MetricServiceTrait
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
}