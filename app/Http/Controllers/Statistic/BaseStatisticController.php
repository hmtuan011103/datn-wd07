<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Services\Statistic\StatisticService;

class BaseStatisticController extends Controller
{
    protected $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }
}
