@extends('layout.app')
@section('title', __('word.country_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.country_title') }}</h2>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="no-sort no-search"></th>
                                        <th class="text-center">{{ __('word.country_name') }}</th>
                                        <th class="text-center">{{ __('word.country_code') }}</th>
                                        <th class="text-center">{{ __('word.flag') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#datatable').DataTable({
                serverSide: true,
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
                ajax: {
                    url: "{{ route('country.data') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1
                    }, {
                        data: 'country_name',
                        name: 'country_name',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'country_code',
                        name: 'country_code',
                        className: 'text-center',
                        responsivePriority: 3
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 4
                    },
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.country_search') }}"
                }
            });
        });
    </script>
@endsection
