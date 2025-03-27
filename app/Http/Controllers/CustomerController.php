<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CustomerCreateRequest;

class CustomerController extends Controller
{
    public function index()
    {
        // $customers = Customer::all();
        // return DataTables::of($customers)
        //     ->addColumn('plus-icon', function ($row) {
        //         return null;
        //     })
        //     ->addColumn('action', function ($row) {
        //         $id = base64_encode($row->id);
        //         $edit_icon = '<button type="button" class="btn btn-primary btn-sm edit-btn" title="Edit"
        //         data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
        //         data-mdb-target="">
        //         <i class="fa-solid fa-pen-to-square"></i>
        //       </button>';
        //         $delete_icon = '<a href="#" class="btn btn-danger btn-sm delete-btn" data-id="' . $id . '" title="Delete">
        //             <i class="fa fa-trash-alt"> </i> 
        //         </a>';
        //         return '<div >' . $edit_icon . $delete_icon . '</div>';
        //     })
        //     ->rawColumns(['action', 'plus-icon'])
        //     ->make(true);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(CustomerCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name'            => $request->name,
                'email'           => $request->email,
                'phone'           => $request->phone,
                'phone2'          => $request->phone2,
                'address'         => $request->address,
            ];
            Customer::create($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Customer created successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e], 500);
        }
    }
}
