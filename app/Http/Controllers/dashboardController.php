<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\View\View;

class dashboardController extends Controller
{
    public function viewDashboard()
    {
        $orderTotals = $this->orderTotals();
        $chartData = $this->chart();
        $totalRevenue = $this->totalRevenue();
        $averageMonthlyRevenue = $this->averageRevenue();
        $averageLaundryWeight = $this->averageWeight();
        $averageLaundryTime = $this->averageLaundryTime();

        $labels = $chartData['labels'];
        $values = $chartData['values'];
        $previousMonthValues = $chartData['previousMonthValues'];
        return view('dashboard')->with(compact('orderTotals', 'labels', 'values', 'previousMonthValues', 'totalRevenue', 'averageMonthlyRevenue', 'averageLaundryWeight', 'averageLaundryTime'));
    }
    public function orderTotals()
    {
        date_default_timezone_set('Asia/Jakarta');
        $totalOrders = DB::connection('mysql')->table('orders')->count();

        $currentMonthOrders = DB::table('orders')
            ->whereYear('orderDate', now()->year)
            ->whereMonth('orderDate', now()->month)
            ->count();

        $lastMonthOrders = DB::table('orders')
            ->whereYear('orderDate', now()->subMonth()->year)
            ->whereMonth('orderDate', now()->subMonth()->month)
            ->count();

        $finishedCount = DB::table('orders')->where('orderStatus', 'Finished')->count();
        $ongoingCount = DB::table('orders')->where('orderStatus', 'Ongoing')->count();
        $overdueCount = DB::table('orders')->where('orderStatus', 'Overdue')->count();

        $orderTotals = [
            'totalOrders' => $totalOrders,
            'currentMonthOrders' => $currentMonthOrders,
            'lastMonthOrders' => $lastMonthOrders,
            'finishedCount' => $finishedCount,
            'ongoingCount' => $ongoingCount,
            'overdueCount' => $overdueCount,
        ];

        return $orderTotals;
    }

    public function chart()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->startOfMonth()->subMonth(); // Get the start of the previous month

        // Retrieve data for the current month
        $currentMonthData = DB::table('orders')
            ->where('orderDate', '>=', $currentMonth)
            ->where('orderDate', '<', $currentMonth->copy()->addMonth())
            ->selectRaw('DATE(orderDate) as orderDay, SUM(nominalOrder) as totalNominalOrder')
            ->groupBy('orderDay')
            ->orderBy('orderDay')
            ->get();

        // Retrieve data for the previous month
        $previousMonthData = DB::table('orders')
            ->where('orderDate', '>=', $previousMonth)
            ->where('orderDate', '<', $previousMonth->copy()->addMonth())
            ->selectRaw('DATE(orderDate) as orderDay, SUM(nominalOrder) as totalNominalOrder')
            ->groupBy('orderDay')
            ->orderBy('orderDay')
            ->get();

        $labels = [];
        $values = [];
        $previousMonthValues = [];

        $startDate = $currentMonth->copy();
        $endDate = $currentMonth->copy()->endOfMonth();

        while ($startDate->lte($endDate)) {
            $labels[] = $startDate->format('j');
            $values[] = 0;
            $previousMonthValues[] = 0;

            $startDate->addDay();
        }

        // Update values based on the data from the current month's orders
        foreach ($currentMonthData as $item) {
            $orderDay = Carbon::parse($item->orderDay);
            $dayIndex = $orderDay->diffInDays($currentMonth);
            $values[$dayIndex] = $item->totalNominalOrder;
        }

        // Update values based on the data from the previous month's orders
        foreach ($previousMonthData as $item) {
            $orderDay = Carbon::parse($item->orderDay);
            $dayIndex = $orderDay->diffInDays($previousMonth);
            $previousMonthValues[$dayIndex] = $item->totalNominalOrder;
        }

        return [
            'labels' => $labels,
            'values' => $values,
            'previousMonthValues' => $previousMonthValues,
        ];
    }

    public function totalRevenue()
    {
        $totalRevenue = DB::connection('mysql')
            ->table('orders')
            ->whereYear('orderDate', Carbon::now()->year)
            ->whereMonth('orderDate', Carbon::now()->month)
            ->sum('nominalOrder');

        return $totalRevenue;
    }

    public function averageRevenue()
    {

        $averageMonthlyRevenue = DB::connection('mysql')
            ->table('orders')
            ->whereYear('orderDate', Carbon::now()->year)
            ->whereMonth('orderDate', Carbon::now()->month)
            ->avg('nominalOrder');
        $averageMonthlyRevenue = round($averageMonthlyRevenue, 0);
        return $averageMonthlyRevenue;
    }

    public function averageWeight()
    {
        $averageLaundryWeight = DB::connection('mysql')
            ->table('orders')
            ->whereYear('orderDate', Carbon::now()->year)
            ->whereMonth('orderDate', Carbon::now()->month)
            ->avg('orderWeight');
        $averageLaundryWeight = round($averageLaundryWeight, 1);
        return $averageLaundryWeight;
    }

    public function averageLaundryTime()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $averageTimeDifference = DB::table('orders')
            ->selectRaw('AVG(TIMESTAMPDIFF(DAY, orderDate, dateReady)) as avg_days, AVG(TIMESTAMPDIFF(HOUR, orderDate, dateReady)) as avg_hours')
            ->where('orderDate', 'like', $currentMonth . '%')
            ->first();

        $averageDays = floor($averageTimeDifference->avg_days);
        $averageHours = $averageTimeDifference->avg_hours % 24;

        $averageLaundryTime = "{$averageDays}d {$averageHours}h";

        return $averageLaundryTime;
    }
}
