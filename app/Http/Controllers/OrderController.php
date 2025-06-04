<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $prices = Price::with('countries')->get();
        return view('order.index', compact('prices'));
    }

    public function customerSearch(Request $request)
    {
        try {
            $searchItem = $request->input('search');
            $customers = Customer::where('name', 'like', '%' . $searchItem . '%')
                ->orWhere('phone', 'like', '%' . $searchItem . '%')
                ->orWhere('address', 'like', '%' . $searchItem . '%')
                ->get();
            return response()->json(['status' => true, 'data' => $customers]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
