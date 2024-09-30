<?php

namespace App\Traits;

use App\Services\MetricServiceInterface;

trait MetricServiceTrait
{
    private MetricServiceInterface $metricService;

    private function getMetricService(): MetricServiceInterface
    {
        return $this->metricService;
    }
}