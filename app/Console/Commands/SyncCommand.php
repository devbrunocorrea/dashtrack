<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MetricServiceInterface;
use App\Models\TinyERP\Order;

class SyncCommand extends Command
{
    protected $signature = 'dashtrack:sync';
    protected $description = 'Sync';

    private MetricServiceInterface $metricService;

    public function __construct(MetricServiceInterface $metricService)
    {
        $this->metricService = $metricService;
        parent::__construct();
    }

    private function syncOrders()
    {
        $this->info('TinyERP :: Pull de Pedidos');
        $this->line('Processing...');

        foreach($this->metricService->getAllOrders() as $orderResponse) {
            $order = Order::updateOrCreate(
                ['id' => $orderResponse['id']],
                $orderResponse
            );
            $this->info(sprintf('%d: OK', $order->id));
        }
        
        $this->info('Done!');
    }

    public function handle(): int
    {
        $this->syncOrders();

        
        return 0;
    }
}