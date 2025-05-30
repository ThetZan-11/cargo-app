@extends('layout.app')
@section('title', __('word.price_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.price_title') }}</h2>
            <button type="button" class="btn btn-primary fs-7 btn-sm" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#createPriceModal">
                <i class="fa-solid fa-plus me-2"></i>{{ __('word.create') }}
            </button>
        </div>
        {{-- Price Modal --}}
        @include('price.create')
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
                                        <th class="text-center">{{ __('word.action') }}</th>
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
                        responsivePriority: 6,
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 1,
                        render: function(data) {
                            return `<img src="${data}" alt="Country flag" style="border: 1px solid #ccc; border-radius: 4px; height: 20px; width: 30px;">`;
                        }
                    },
                    {
                        data: 'min_kg',
                        name: 'min_kg',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'max_kg',
                        name: 'max_kg',
                        className: 'text-center',
                        responsivePriority: 3
                    },
                    {
                        data: 'price_per_kg',
                        name: 'price_per_kg',
                        className: 'text-center',
                        responsivePriority: 4
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 5
                    },
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.price_search') }}"
                }
            });

            const customSelect = document.querySelector('.custom-select');
            const selectedOption = customSelect.querySelector('.selected-option');
            const optionsContainer = customSelect.querySelector('.options-container');
            const options = customSelect.querySelectorAll('.option');
            const realSelect = document.querySelector('#country-select');
            const selectedImage = customSelect.querySelector('#selected-country-image');
            const selectedText = customSelect.querySelector('#selected-country-text');

            // Set initial selected option from real select
            if (realSelect.value) {
                const selected = Array.from(options).find(opt => opt.dataset.value === realSelect.value);
                if (selected) {
                    const img = selected.querySelector('.option-image');
                    selectedImage.src = img.src;
                    selectedImage.style.display = 'inline-block';
                    selectedText.textContent = selected.querySelector('.option-text').textContent;
                }
            }

            // Toggle options visibility
            selectedOption.addEventListener('click', function(e) {
                e.stopPropagation();
                customSelect.classList.toggle('active');
            });

            // Select an option
            options.forEach(option => {
                option.addEventListener('click', function() {
                    const img = this.querySelector('.option-image');
                    const text = this.querySelector('.option-text').textContent;
                    const value = this.dataset.value;

                    selectedImage.src = img.src;
                    selectedImage.style.display = 'inline-block';
                    selectedText.textContent = text;
                    realSelect.value = value;

                    customSelect.classList.remove('active');
                });
            });

            // Close when clicking outside
            document.addEventListener('click', function() {
                customSelect.classList.remove('active');
            });

            // Sync with real select if changed programmatically
            realSelect.addEventListener('change', function() {
                if (this.value) {
                    const selected = Array.from(options).find(opt => opt.dataset.value === this.value);
                    if (selected) {
                        const img = selected.querySelector('.option-image');
                        selectedImage.src = img.src;
                        selectedImage.style.display = 'inline-block';
                        selectedText.textContent = selected.querySelector('.option-text').textContent;
                    }
                } else {
                    selectedImage.style.display = 'none';
                    selectedText.textContent = 'Open this select menu';
                }
            });
        });
    </script>
@endsection
