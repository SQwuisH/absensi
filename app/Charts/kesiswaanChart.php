<?php

namespace App\Charts;

use App\Models\absensi;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class kesiswaanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $S = Carbon::now()->startOfWeek();
        $start = $S->format('Y-m-d');
        $end = carbon::now()->endOfWeek()->subday(2)->format('Y-m-d');

        // Apply date range filtering
        $query = absensi::whereBetween('date', [$start, $end])->get();

        $filteredData = $query->groupby('date');

        foreach ($filteredData as $fD) {
            $hadir[] =  $fD->where('status', 'hadir')->count();
            $tidakHadir[] = $fD->wherein('status', ['sakit', 'izin', 'alfa'])->count();
            $date[] = $S->translatedFormat('D, Y-m-d');
            $S = $S->addDay();
        }

        return $this->chart->barChart()
            ->addData('Hadir', $hadir)
            ->addData('Tidak Hadir', $tidakHadir)
            ->setXAxis($date)
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
    }
}
