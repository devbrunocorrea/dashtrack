<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\MetricServiceTrait;
use App\Services\MetricServiceInterface;
use App\Repositories\MetricRepositoryInterface;

class DashboardController extends Controller
{
    use MetricServiceTrait;
    
    protected MetricRepositoryInterface $metricRepository;

    public function __construct(MetricServiceInterface $metricService, MetricRepositoryInterface $metricRepository)
    {
        $this->metricService = $metricService;
        $this->metricRepository = $metricRepository;
    }

    public function getRepository(): MetricRepositoryInterface
    {
        return $this->metricRepository;
    }

    public function dashboard()
    {
        return view('dashboard', [
            'totalOrders' => $this->getRepository()->findTotalOrders(),
            'totalOrdersCanceled' => $this->getRepository()->findTotalOrdersCanceled(),
            'totalOrdersDelivered' => $this->getRepository()->findTotalOrdersDelivered(),
            'totalOrdersDoneToDelivery' => $this->getRepository()->findTotalOrdersDoneToDelivery(),
            'totalOrdersIncompleteData' => $this->getRepository()->findTotalOrdersIncompleteData(),

            'sales' => $this->getRepository()->findSalesCurrentYear(),
        ]);
    }
}
