<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\TinyERP\Order;

class MetricRepository implements MetricRepositoryInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function findTotalOrders(): int
    {
        return $this->order->all()->count();
    }
    
    public function findTotalOrdersCanceled(): int
    {
        return $this->order->where('situacao', 'Cancelado')->count();
    }
	
    public function findTotalOrdersDelivered(): int
    {
        return $this->order->where('situacao', 'Entregue')->count();
    }

    public function findTotalOrdersDoneToDelivery(): int
    {
        return $this->order->where('situacao', 'Pronto para envio')->count();
    }

    public function findTotalOrdersIncompleteData(): int
    {
        return $this->order->where('situacao', 'Dados incompletos')->count();
    }

    public function findSalesCurrentYear(): array
    {
        $sales = DB::table('tinyerp_pedidos')
            ->selectRaw('DATE_FORMAT(data_pedido, "%Y-%m") as month, SUM(valor) as total_sales')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return $sales->pluck('total_sales', 'month')->toArray();
    }

    public function findSalesPerYear(): array
    {
        $sales = DB::table('tinyerp_pedidos')
            ->selectRaw('YEAR(data_pedido) as year, SUM(valor) as total_sales')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        return $sales->pluck('total_sales', 'year')->toArray();
    }
    
}