<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return DataTables::of($customers)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $edit_icon = '<button type="button" class="btn btn-primary btn-sm edit-btn" title="Edit"
                data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>';
                $delete_icon = '<a href="#" class="btn btn-danger btn-sm delete-btn" data-id="' . $id . '" title="Delete">
                    <i class="fa fa-trash-alt"> </i> 
                </a>';
                return '<div >' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action', 'plus-icon'])
            ->make(true);
    }
}
