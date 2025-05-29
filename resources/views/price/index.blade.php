@extends('layout.app')
@section('title', __('word.price_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.price_title') }}</h2>
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
                                        <th class="text-center">{{ __('word.flag') }}</th>
                                        <th class="text-center">{{ __('word.min_kg') }}</th>
                                        <th class="text-center">{{ __('word.max_kg') }}</th>
                                        <th class="text-center">{{ __('word.price') }}</th>
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
                beforeSend: function() {
                    $('#loader').css('display', 'flex');
                },
                ajax: {
                    url: "{{ route('price.data') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                complete: function() {
                    $('#loader').css('display', 'none');
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 4,
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 3,
                        render: function(data) {
                            return `<img src="${data}" alt="Country flag" style="border: 1px solid #ccc; border-radius: 4px; height: 20px; width: 30px;">`;
                        }
                    },
                    {
                        data: 'min_kg',
                        name: 'min_kg',
                        className: 'text-center',
                        responsivePriority: 1
                    },
                    {
                        data: 'max_kg',
                        name: 'max_kg',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'price_per_kg',
                        name: 'price_per_kg',
                        className: 'text-center',
                        responsivePriority: 4
                    }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.price_search') }}"
                }
            });
        });
    </script>
@endsection
