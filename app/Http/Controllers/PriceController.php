<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PriceEditRequest;
use App\Http\Requests\PriceCreateRequest;

class PriceController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('price.index', compact('countries'));
    }

    public function getData()
    {
        $prices = Price::with('countries');
        return datatables()->of($prices)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->editColumn('min_kg', function ($row) {
                return $row->min_kg . ' Kg';
            })
            ->editColumn('max_kg', function ($row) {
                return $row->max_kg . ' Kg';
            })
            ->editColumn('price_per_kg', function ($row) {
                // var_dump($row->countries->country_code);
                $row->countries->country_code == 'SG' ? $unit = " $" : $unit = " MMK";
                return number_format($row->price_per_kg, 2) . $unit;
            })
            ->addColumn('country_flag', function ($row) {
                return $row->countries->country_flag;
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $edit_icon = '<button type="button" class="btn btn-edit btn-sm edit-btn" title="Edit"
                data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#editPriceModal" data-mdb-toggle="modal">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>';
                $delete_icon = '<button type="button" class="btn btn-delete btn-sm delete-btn" data-id="' . $id . '" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                </button>';
                return '<div class="action-buttons">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['plus-icon', 'country_flag', 'action'])
            ->make(true);
    }

    public function store(PriceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'country_id'     => $request->country,
                'min_kg'         => $request->min_kg,
                'max_kg'         => $request->max_kg,
                'price_per_kg'   => $request->price,
            ];
            Price::create($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Price created successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        if (request()->ajax()) {
            try {
                DB::beginTransaction();
                $price = Price::findOrFail(base64_decode($id));
                $price->delete();
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Price deleted successfully']);
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function getDataEdit($id)
    {
        if (request()->ajax()) {
            try {
                $price = Price::with('countries')->findOrFail(base64_decode($id));
                return response()->json(['status' => true, 'data' => $price]);
            } catch (\Throwable $e) {
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function update(PriceEditRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $oldprice = Price::findOrFail(base64_decode($id));
            $oldprice->delete();
            $data = [
                'country_id'     => $request->edit_country,
                'min_kg'         => $request->edit_min_kg,
                'max_kg'         => $request->edit_max_kg,
                'price_per_kg'   => $request->edit_price,
            ];
            Price::create($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Price updated successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
