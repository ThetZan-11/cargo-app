@extends('layout.app')
@section('title', 'Customers')
@section('content')
    <h1>Customers</h1>
    <div class="row justify-content-center">
        <div class="card col-md-11">
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('customer.create') }}" class="btn btn-primary" data-mdb-ripple-init>
                        <i class="fa-solid fa-plus"></i> Add Customer
                    </a>
                </div>
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th class="no-sort no-search"></th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Phone 2</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('customer.data') }}",
                    "type": "POST",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    }, {
                        data: 'name',
                        name: 'name',
                        class: 'text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        class: 'text-center'
                    },
                    {
                        data: 'address',
                        name: 'address',
                        class: 'text-center'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        class: 'text-center'
                    },
                    {
                        data: 'phone2',
                        name: 'phone2',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    }
                ]
            });
        });
    </script>
