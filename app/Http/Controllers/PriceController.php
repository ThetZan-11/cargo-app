<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Price;
use Illuminate\Http\Request;

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
                return number_format($row->price_per_kg, 2) . ' MMK';
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
                $delete_icon = '<button type="button" class="btn btn-delete btn-sm price-delete-btn" data-id="' . $id . '" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                </button>';
                return '<div class="action-buttons">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['plus-icon', 'country_flag', 'action'])
            ->make(true);
    }
}
