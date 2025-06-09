<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Price;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(OrderCreateRequest $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();
            $data = [
                'customer_id'     => $request->customer_hidden_id,
                'price_id'         => $request->selected_price_id,
                'total_kg'         => $request->total_kg,
                'price_per_kg'   => $request->arp_no,
                'price_per_kg'   => $request->order_date,
            ];
            Price::create($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Price created successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
