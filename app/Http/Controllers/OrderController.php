<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Order;
use App\Models\Price;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderCreateRequest;
use App\Models\Product;
use App\Models\Receipt;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $prices = Price::with('countries')->get();
        $products = Product::where('id', '!=', 1)->get();
        return view('order.index', compact('prices', 'products'));
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
            $meat_status =  $request->meat_kg_plus != '' ? 1 : 0;
            $book_status =  $request->book_kg_plus != '' ? 1 : 0;
            $pharmacy_status =  $request->pharmacy_kg_plus != '' ? 1 : 0;
            $cloth_status =  $request->cloth_kg_plus != '' ? 1 : 0;

            $total_amount = $request->various_amount
                + $request->meat_total +
                $request->book_total +
                $request->pharmacy_total +
                $request->cloth_total +
                $request->box_total;

            $total_kg = $request->various_kg
                + $request->meat_kg_plus +
                $request->book_kg_plus +
                $request->pharmacy_kg_plus +
                $request->cloth_kg_plus;

            $reciptData = [
                'customer_id'   => $request->customer_hidden_id,
                'arp_no'        => $request->arp_no,
                'order_date'    => Carbon::parse($request->order_date)->format('Y-m-d'),
                'description'   => $request->order_desc,
                'total_amount'  => $total_amount,
                'price_id'      => $request->selected_price_id,
                'total_kg'      => $total_kg,
                'sender_name'   => $request->sender_name,
                'sender_address' => $request->sender_address,
            ];
            $receipt = Receipt::create($reciptData);

            if ($receipt) {
                $orderData = [
                    'product_id'       => 1,
                    'receipt_id'       => $receipt->id,
                    'total_kg'         => $request->various_kg,
                    'line_total'       => $request->various_amount,
                    'status'           => 1
                ];
                Order::create($orderData);
                if (isset($request->meat_kg) && isset($request->meat_total) && isset($request->meat)) {
                    $meatData = [
                        'product_id'       => $request->meat,
                        'receipt_id'       => $receipt->id,
                        'total_kg'         => $request->meat_kg,
                        'line_total'       => $request->meat_total,
                        'status'           => $meat_status
                    ];
                    Order::create($meatData);
                }
                if (isset($request->book_kg) && isset($request->book_total) && isset($request->book)) {
                    $bookData = [
                        'product_id'       => $request->book,
                        'receipt_id'       => $receipt->id,
                        'total_kg'         => $request->book_kg,
                        'line_total'       => $request->book_total,
                        'status'           => $book_status
                    ];
                    Order::create($bookData);
                }
                if (isset($request->pharmacy_kg) && isset($request->pharmacy_total) && isset($request->pharmacy)) {
                    $pharmacyData = [
                        'product_id'       => $request->pharmacy,
                        'receipt_id'       => $receipt->id,
                        'total_kg'         => $request->pharmacy_kg,
                        'line_total'       => $request->pharmacy_total,
                        'status'           => $pharmacy_status
                    ];
                    Order::create($pharmacyData);
                }
                if (isset($request->cloth_kg) && isset($request->cloth_total) && isset($request->cloth)) {
                    $clothData = [
                        'product_id'       => $request->cloth,
                        'receipt_id'       => $receipt->id,
                        'total_kg'         => $request->cloth_kg,
                        'line_total'       => $request->cloth_total,
                        'status'           => $cloth_status
                    ];
                    Order::create($clothData);
                }
                if (isset($request->box) && isset($request->box_total) && isset($request->box)) {
                    $boxData = [
                        'product_id'       => $request->box,
                        'receipt_id'       => $receipt->id,
                        'total_kg'         => $request->box_kg,
                        'line_total'       => $request->box_total,
                        'status'           => 0
                    ];
                    Order::create($boxData);
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Order created successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getData()
    {
        $orders = Order::join('receipts', 'receipts.id', '=', 'orders.receipt_id')
            ->join('customers', 'customers.id', '=', 'receipts.customer_id')
            ->join('prices', 'prices.id', '=', 'receipts.price_id')
            ->join('countries', 'countries.id', '=', 'prices.country_id')
            ->select(
                'receipts.id as receipt_id',
                'customers.name',
                'customers.address',
                'receipts.id',
                'receipts.customer_id',
                'countries.country_flag',
                'countries.country_code',
                'receipts.total_kg',
                'receipts.total_amount',
                'receipts.arp_no',
                'receipts.order_date'
            )
            ->groupBy(
                'receipts.id',
                'customers.name',
                'customers.address',
                'receipts.customer_id',
                'countries.country_flag',
                'receipts.arp_no',
                'receipts.order_date',
                'countries.country_code',
                'receipts.total_kg',
                'receipts.total_amount',
            )
            ->get();
        return DataTables::of($orders)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->addColumn('checkbox', function ($row) {
                return '<input class="form-check-input printCheckbox" type="checkbox" value="' . $row->customer_id . '" />';
            })
            ->addColumn('name', function ($row) {
                return $row->name ?? '-';
            })
            ->addColumn('address', function ($row) {
                return strlen($row->address) >= 20
                    ? substr($row->address, 0, 20) . '...'
                    : $row->address;
            })
            ->addColumn('country_flag', function ($row) {
                return '<img src="' . $row->country_flag . '" alt="country" style="border:1px solid black; width:50px;">';
            })
            ->editColumn('total_kg', function ($row) {
                return number_format($row->total_kg, 2) . ' Kg';
            })
            ->addColumn('total_amount', function ($row) {
                $currencyCode = $row->country_code == "SG" ? ' $' : ' MMK';
                return number_format($row->total_amount, 0) . $currencyCode;
            })
            ->editColumn('order_date', function ($row) {
                return \Carbon\Carbon::parse($row->order_date)->format('d-M-Y');
            })
            ->addColumn('arp_no', function ($row) {
                return $row->arp_no ?? '-';
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
            ->rawColumns(['checkbox', 'country_flag', 'action'])
            ->make(true);
    }

    public function getDataEdit($id)
    {
        if (request()->ajax()) {
            try {
                $receipt = Receipt::with('orders', 'customers', 'prices', 'orders.products')->where('id', base64_decode($id))->first();
                return response()->json(['status' => true, 'receipt' => $receipt]);
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
                    array_push($customers, Receipt::with('customers')
                        ->where('customer_id', $printId)
                        ->first());
                }
                return response()->json(['status' => true, 'data' => $customers]);
            } catch (\Throwable $e) {
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }
}
