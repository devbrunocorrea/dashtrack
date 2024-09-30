<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Indicator::create(['name' => 'Total de Pedidos', 'description' => 'Total de pedidos', 'source' => 'tinyerp_total_orders']);
        Indicator::create(['name' => 'Total de Pedidos Cancelados', 'description' => 'Total de pedidos cancelados', 'source' => 'tinyerp_total_orders_canceled']);
        Indicator::create(['name' => 'Total de Pedidos Entregues', 'description' => 'Total de pedidos entregues', 'source' => 'tinyerp_total_orders_delivered']);
        Indicator::create(['name' => 'Total de Pedidos do dia', 'description' => 'Total de pedidos novos', 'source' => 'tinyerp_total_orders_today']);
        Indicator::create(['name' => 'Total de Pedidos para entrega hoje', 'description' => 'Total de pedidos para entregar hoje', 'source' => 'tinyerp_total_orders_to_delivery']);
    }
}
