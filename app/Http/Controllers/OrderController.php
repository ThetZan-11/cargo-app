<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Order;
use App\Models\Price;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderCreateRequest;
use Yajra\DataTables\Facades\DataTables;

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
        try {
            DB::beginTransaction();
            $formatter = new NumberFormatter('de_DE', NumberFormatter::DECIMAL);
            $decimal_price_value = $formatter->parse($request->selected_price_id);
            $data = [
                'customer_id'       => $request->customer_hidden_id,
                'price_id'          => $request->selected_price_id,
                'total_kg'          => $request->total_kg,
                'total_amount'      => $decimal_price_value,
                'arp_no'            => $request->arp_no,
                "order_date"        => $request->order_date,
                "status"            => 0,
                // "remark"            => $request->remark,
            ];
            Order::create($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Order created successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getData()
    {
        $orders = Order::with('customers', 'prices');
        // dd($orders);
        return DataTables::of($orders)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->addColumn('name', function ($row) {
                return $row->customers->name ?? '-';
            })
            ->addColumn('address', function ($row) {
                return $row->customers->address ?? '-';
            })
            ->editColumn('total_amount', function ($row) {
                return $row->total_amount . " MMK";
            })
            ->editColumn('status', function ($row) {
                return $row->status == 0 ? "Pending" : "Complete";
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $detail_icon = '<button type="button" class="btn btn-detail btn-sm detail-btn" title="detail"
                data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#detailOrderModal" data-mdb-toggle="modal">
              <i class="fa-solid fa-eye"></i>
              </button>';
                $edit_icon = '<button type="button" class="btn btn-edit btn-sm edit-btn" title="Edit"
                data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#editOrderrModal" data-mdb-toggle="modal">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>';
                $delete_icon = '<button type="button" class="btn btn-delete btn-sm delete-btn" data-id="' . $id . '" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                </button>';
                return '<div class="action-buttons">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
