<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\MetricServiceTrait;

class DashboardController extends Controller
{
    use MetricServiceTrait;

    public function dashboard()
    {
        $orders = $this->getMetricService()->getOrders();
        $totalOrders = \count($orders["pedidos"]["pedido"]);

        return view('dashboard', [
            'totalOrders' => $totalOrders,
            'totalInvoices' => $totalOrders,
            'totalItems' => $totalOrders,
            'totalSellers' => $totalOrders,
        ]);
    }
}
