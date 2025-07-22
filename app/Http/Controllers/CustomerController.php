<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CustomerEditRequest;
use App\Http\Requests\CustomerCreateRequest;
use Termwind\Components\Dd;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function getData()
    {
        $customers = Customer::all();
        return DataTables::of($customers)
            ->addColumn('plus-icon', function ($row) {
                return null;
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $edit_icon = '<button type="button" class="btn btn-edit btn-sm edit-btn" title="Edit"
                data-id="' . $id . '" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#editCustomerModal" data-mdb-toggle="modal">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>';
                $delete_icon = '<button type="button" class="btn btn-delete btn-sm delete-btn" data-id="' . $id . '" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                </button>';
                return '<div class="action-buttons">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
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
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        if (request()->ajax()) {
            try {
                DB::beginTransaction();
                $customer = Customer::findOrFail(base64_decode($id));
                if ($customer->receipts()->count() > 0) {
                    return response()->json(['status' => false, 'error' => 'Cannot delete customer with existing orders.']);
                }
                $customer->delete();
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Customer deleted successfully']);
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function getDataEdit($id)
    {
        if (request()->ajax()) {
            $customer = Customer::findOrFail(base64_decode($id));
            return response()->json(['status' => true, 'data' => $customer]);
        }
    }

    public function update(CustomerEditRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::findOrFail(base64_decode($id));
            $data = [
                'name'      => $request->edit_name,
                'email'     => $request->edit_email,
                'phone'     => $request->edit_phone,
                'phone2'    => $request->edit_phone2,
                'address'   => $request->edit_address,
            ];
            $customer->update($data);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Customer updated successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
