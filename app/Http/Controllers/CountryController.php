<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index()
    {
        return view('country.index');
    }

    public function getData()
    {
        $countries = Country::all();
        return DataTables::of($countries)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })->editColumn('country_flag', function ($row) {
                return '<img src="' . $row->country_flag . '" alt="' . $row->country_name . '" style="width: 30px; height: 20px;">';
            })
            ->rawColumns(['country_flag'])
            ->make(true);
    }
}
