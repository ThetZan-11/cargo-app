@extends('layout.app')
@section('title', 'Customers')
@section('content')
    <h1>Customers</h1>
    <div class="row justify-content-center">
        <div class="card col-md-11">
            <div class="card-body">
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th class="no-sort no-search"></th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Phone 1</th>
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
                ajax: {
                    "url": "{{ route('customer.index') }}",
                    "type": "POST",
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    }, {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone1',
                        name: 'phone1'
                    },
                    {
                        data: 'phone2',
                        name: 'phone2'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
