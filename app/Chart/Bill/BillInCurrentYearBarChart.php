<?php

namespace App\Chart\Bill;

use App\Chart\Src\DataSet;
use App\Chart\Src\Types\BarChart;
use App\Models\Bill;
use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class BillInCurrentYearBarChart extends BarChart
{
    public function getCollection(): Collection
    {
        return Bill::query()
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month_name' => Carbon::create()->month((int)$item->month)->translatedFormat('F'),
                    'total' => $item->total,
                ];
            });
    }


    public function getLabels(): array
    {
        return $this->result->pluck('month_name')->toArray();
    }

    public function getDataSets(): array
    {
        return [
            DataSet::make()->setLabel(__('message.bills'))
                ->setData($this->result->pluck('total')->toArray())
//                ->setBackgroundColor(DataSet::getColors( 12,0))
                ->toArray(),
        ];
    }


    public function canAccess(): bool
    {
        return true;
    }
}
