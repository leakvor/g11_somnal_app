<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of users with role number 2
        $userCount = User::where('role_id', 2)->count();

        // Fetch the count of companies with role number 3
        $companyCount = User::where('role_id', 3)->count();

        // Fetch the count of categories in the category table
        $scrapCount = Category::count();

        // Fetch total revenue by month
        $monthlyRevenue = DB::table('payments')
            ->select(DB::raw('MONTH(payments.created_at) as month'), DB::raw('SUM(option_paids.amount) as total'))
            ->join('option_paids', 'payments.option_paid_id', '=', 'option_paids.id')
            ->groupBy(DB::raw('MONTH(payments.created_at)'))
            ->orderBy(DB::raw('MONTH(payments.created_at)'))
            ->get();

        // Prepare data for chart
        $revenueData = array_fill(0, 12, 0); // Initialize an array with 12 months of zero
        foreach ($monthlyRevenue as $revenue) {
            if ($revenue->month >= 1 && $revenue->month <= 12) {
                $revenueData[$revenue->month - 1] = $revenue->total;
            }
        }

        // Calculate total revenue from monthly data
        $totalRevenue = $monthlyRevenue->sum('total'); 

        return view('dashboard', [
            'userCount' => $userCount,
            'companyCount' => $companyCount,
            'scrapCount' => $scrapCount,
            'totalRevenue' => $totalRevenue,
            'revenueData' => $revenueData,
        ]);
    }
}