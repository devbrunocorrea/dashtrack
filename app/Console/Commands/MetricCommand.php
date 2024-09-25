<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MetricServiceInterface;

class MetricCommand extends Command
{
    protected $signature = 'dashtrack:check';
    protected $description = 'Show Metrics';

    private MetricServiceInterface $metricService;

    public function __construct(MetricServiceInterface $metricService)
    {
        $this->metricService = $metricService;
        parent::__construct();
    }

    private function showInfoTable()
    {
        $info = $this->metricService->getInfo();
        $columns = array_slice(array_keys($info["conta"]),0,5);
        $rows = [array_slice(array_values($info["conta"]),0,5)];
        $this->table($columns, $rows);
    }

    public function handle(): int
    {
        $this->showInfoTable();
        
        return 0;
    }
}