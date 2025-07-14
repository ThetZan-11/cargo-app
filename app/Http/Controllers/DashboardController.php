<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function getData(Request $request)
    {
        try {
            $customer_count = Customer::count();
            $total_order = Receipt::count();
            $monthMap = [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12
            ];

            $selectedMonth = $request->input('month');
            $selectedYear = $request->input('year');
            $now = Carbon::now();

            $year = $selectedYear ?? $now->year;

            // If month is selected → return only that month's data
            if ($selectedMonth && isset($monthMap[$selectedMonth])) {
                $monthNum = $monthMap[$selectedMonth];
                $count = Receipt::whereYear('created_at', $year)
                    ->whereMonth('created_at', $monthNum)
                    ->count();

                return response()->json([
                    'status' => true,
                    'data' => [$selectedMonth => $count]
                ]);
            }

            // No month selected → return all months for that year
            $monthlyData = [];
            foreach ($monthMap as $monthName => $monthNum) {
                $monthlyData[$monthName] = Receipt::whereYear('created_at', $year)
                    ->whereMonth('created_at', $monthNum)
                    ->count();
            }

            return response()->json([
                'status' => true,
                'data' => $monthlyData,
                'customer_count' => $customer_count,
                'total_order' => $total_order
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to load data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
