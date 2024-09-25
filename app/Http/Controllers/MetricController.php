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
     *     path="/api/items",
     *     tags={"metric"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function getItems(): string
    {
        $service = $this->getMetricService();

        return json_encode($service->getItems());
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

        return json_encode($service->getInvoices());
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

        return json_encode($service->getSellers());
    }
}
