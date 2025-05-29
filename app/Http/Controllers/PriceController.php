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
            ->addColumn('country_flag', function ($row) {
                return $row->countries->country_flag;
            })
            ->rawColumns(['plus-icon', 'country_flag'])
            ->make(true);
    }
}
