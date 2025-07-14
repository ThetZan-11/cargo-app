@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
<style>
    body.dashboard-bg {
        background: linear-gradient(120deg, #cfcf8e 0%, #ffe066 50%, #ffb347 100%) !important;
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.22);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 28px;
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: box-shadow 0.2s, transform 0.2s;
        margin-bottom: 18px;
        position: relative;
        overflow: hidden;
    }
    .glass-select{
        background: rgba(255, 255, 255, 0.22);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 28px;
        border: 1.5px solid rgba(255, 255, 255, 0.35);

    }
    .glass-card:before {
        content: '';
        position: absolute;
        top: -40%;
        left: -40%;
        width: 180%;
        height: 180%;
        background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0) 70%);
        z-index: 0;
    }
    .glass-card > * {
        position: relative;
        z-index: 1;
    }
    .glass-card:hover {
        box-shadow: 0 16px 40px 0 rgba(31, 38, 135, 0.32);
        transform: translateY(-4px) scale(1.03);
    }
    .glass-title {
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 8px rgba(31,38,135,0.12);
    }
    .glass-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: 1px;
        text-shadow: 0 2px 8px rgba(31,38,135,0.18);
    }
    .glass-chart-card {
        background: rgba(255,255,255,0.24);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.22);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 28px;
        border: 1.5px solid rgba(255,255,255,0.35);
        padding: 2.2rem 2.5rem 1.5rem 2.5rem;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }
    .glass-chart-card:before {
        content: '';
        position: absolute;
        top: -40%;
        left: -40%;
        width: 180%;
        height: 180%;
        background: radial-gradient(circle, rgba(255,255,255,0.13) 0%, rgba(255,255,255,0) 70%);
        z-index: 0;
    }
    .glass-chart-card > * {
        position: relative;
        z-index: 1;
    }
</style>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="glass-card">
                <div class="glass-title">Total Orders</div>
                <div class="glass-value" id="total_order"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <div class="glass-title">Total Customers</div>
                <div class="glass-value" id="total_customer"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <div class="glass-title">Active Countries</div>
                <div class="glass-value">4</div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="glass-chart-card">
                <h3 class="mb-3">Total Order Chart</h3>
                <div class="row">
                    <div class="col-md-4 mx-auto mb-4">
                        <div class="glass-select">
                            <select id="month-select" class="form-select" style="background: rgba(255,255,255,0.15); border: none; color: #debf0e; font-weight: 600; box-shadow: 0 2px 6px rgba(31,38,135,0.2); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border-radius: 10px;">
                                <option value="">All Months</option>
                                @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mx-auto mb-4">
                        <div class="glass-select">
                            <select id="year-select" class="form-select" style="background: rgba(255,255,255,0.15); border: none; color: #debf0e; font-weight: 600; box-shadow: 0 2px 6px rgba(31,38,135,0.2); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border-radius: 10px;">
                                <option value="">This Year</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                    </div>
                </div>
                <canvas id="ordersBarChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    document.body.classList.add('dashboard-bg');
</script>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.body.classList.add('dashboard-bg');

    const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const ctx = document.getElementById('ordersBarChart').getContext('2d');
    const ordersBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Orders',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    function fetchChartData() {
        const selectedMonth = $('#month-select').val();
        const selectedYear = $('#year-select').val();

        $.ajax({
            type: 'GET',
            url: "{{ route('dashboard.getData') }}",
            data: {
                month: selectedMonth,
                year: selectedYear
            },
            success: function(response) {
                $('#total_order').text(response.total_order)
                $('#total_customer').text(response.customer_count)
                const monthlyOrders = response.data;
                const newData = chartLabels.map(month => monthlyOrders[month] || 0);
                ordersBarChart.data.datasets[0].data = newData;
                ordersBarChart.update();
            },
            error: function(xhr) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "{{ __('word.failed_to_fetch') }}",
                    showConfirmButton: false,
                    timer: 1500,
                    fadeIn: 1000,
                });
            }
        });
    }

    $(document).ready(() => {
        fetchChartData();

        $('#month-select, #year-select').on('change', function () {
            fetchChartData();
        });
    });
</script>
@endsection
