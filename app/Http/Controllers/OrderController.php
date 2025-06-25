<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Order;
use App\Models\Price;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderCreateRequest;
use Carbon\Carbon;
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
            $total_float_value = floatval(str_replace(',', '', $request->total_amount));
            $data = [
                'customer_id'       => $request->customer_hidden_id,
                'price_id'          => $request->selected_price_id,
                'total_kg'          => $request->total_kg,
                'total_amount'      => $total_float_value,
                'arp_no'            => $request->arp_no,
                "status"            => $request->order_status,
                "description"       => $request->order_desc,
                "order_date"        => $request->order_date,
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
        $orders = Order::with([
                'receipts',
                'prices' => function ($query) {
                    $query->withTrashed();
                }
            ])->get();
        // $order_group = $orders->groupBy('receipt_id');
        return DataTables::of($orders)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->addColumn('checkbox', function ($row) {
                return '<input class="form-check-input printCheckbox" type="checkbox" value="' . $row->receipts->customer_id . '" id="printCheckbox" />';
            })
            ->addColumn('name', function ($row) {
                return $row->receipts->customers->name ?? '-';
            })
            ->addColumn('address', function ($row) {
                return strlen($row->receipts->customers->address) >= 20 ? substr($row->receipts->customers->address, 0, 20,) . '...' : $row->receipts->customers->address;
            })
            ->addColumn('country_flag', function ($row) {
                return '<img src="' . $row->prices->countries->country_flag . '" alt="country" style="border:1px solid black; width:50px;" >';
            })
            ->editColumn('total_kg', function ($row) {
                return $row->total_kg . ' Kg';
            })
            ->addColumn('total_amount', function ($row) {
                return $row->receipts->total_amount . ' MMK' ?? '-';
            })
            ->editColumn('order_date', function ($row) {
                return Carbon::parse($row->receipts->order_date)->format('d-M-Y');
            })
            ->addColumn('arp_no', function ($row) {
                return $row->receipts->arp_no ?? '-';
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
                return '<div class="action-buttons">' . $detail_icon . $edit_icon . '</div>';
            })
            ->rawColumns(['action', 'checkbox', 'country_flag'])
            ->make(true);
    }

    public function getDataEdit($id)
    {
        if (request()->ajax()) {
            try {
                $orders = Order::with([
                    'customers',
                    'prices' => function ($query) {
                        $query->withTrashed();
                    }
                ])->findOrFail(base64_decode($id));
                return response()->json(['status' => true, 'data' => $orders]);
            } catch (\Throwable $e) {
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function printData(Request $request)
    {
        if (request()->ajax()) {
            try {
                $req =  $request->json()->all();
                $printIdArr = $req['printId'];
                $customers = [];
                foreach ($printIdArr as $printId) {
                    array_push($customers, Customer::find($printId));
                }
                return response()->json(['status' => true, 'data' => $customers]);
            } catch (\Throwable $e) {
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }
}
