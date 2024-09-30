<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use OpenApi\Annotations\OA;
use OpenApi\Annotations\PathItem;
use OpenApi\Annotations\Info;
use App\Traits\MetricServiceTrait;

/**
 * @OA\Info(title="DashTrack API", version="0.1")
 */
class MetricController extends Controller
{
    use MetricServiceTrait;

    /**
     * @OA\Get(
     *     path="/api/info",
     *     tags={"api"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getInfo(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getInfo());
    }

    /**
     * @OA\Get(
     *     path="/api/orders",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getOrders(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getOrders());
    }
    
    /**
     * @OA\Get(
     *     path="/api/metrics",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getMetricSummary()
    {
        return json_encode([
            'tinyerp_total_orders' => $this->repository->getTotalOrders(),
            'tinyerp_total_orders_canceled' => $this->repository->getTotalOrdersCanceled(),
            'tinyerp_total_orders_delivered' => $this->repository->getTotalOrdersDelivered(),
        ]);
    }

     /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getProducts(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getByEntity($this->getMetricService()::ENTITY_PRODUCT));
    }

     /**
     * @OA\Get(
     *     path="/api/invoices",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getInvoices(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getByEntity($this->getMetricService()::ENTITY_INVOICE));
    }

     /**
     * @OA\Get(
     *     path="/api/sellers",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getSellers(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getByEntity($this->getMetricService()::ENTITY_SELLER));
    }
}
