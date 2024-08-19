@extends('layouts.app')
<title>Dashboard</title>

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Daily Sales Overview</h3>
                    <canvas id="dailySalesChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Category-wise Sales (Monthly)</h3>
                    <canvas id="categorySalesChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxLine = document.getElementById('dailySalesChart').getContext('2d');
        const dailySalesChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!}, // X-axis labels (dates)
                datasets: [{
                    label: 'Daily Sales',
                    data: {!! json_encode($totals) !!}, // Y-axis data (total sales)
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Script for Doughnut Chart -->
    <script>
        const ctxDoughnut = document.getElementById('categorySalesChart').getContext('2d');
        const categorySalesChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach ($categorySales as $categorySale)
                        '{{ $categorySale->category_name }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($categorySales as $categorySale)
                            {{ $categorySale->total_sales }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
