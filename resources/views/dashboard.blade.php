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
                    <h3 class="font-semibold text-lg">Monthly Sales Overview</h3>
                    <canvas id="monthlySalesChart" style="max-height: 400px;"></canvas>
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

        // Create a gradient for the line
        const lineGradient = ctxLine.createLinearGradient(0, 0, 0, 400);
        lineGradient.addColorStop(0, 'rgba(54, 162, 235, 1)');  // Starting color (blue)
        lineGradient.addColorStop(1, 'rgba(75, 192, 192, 1)');  // Ending color (greenish)

        // Create a gradient for the background area of the line chart
        const backgroundGradient = ctxLine.createLinearGradient(0, 0, 0, 400);
        backgroundGradient.addColorStop(0, 'rgba(54, 162, 235, 0.2)');
        backgroundGradient.addColorStop(1, 'rgba(75, 192, 192, 0.2)');

        const dailySalesChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!}, // X-axis labels (dates)
                datasets: [{
                    label: 'Daily Sales',
                    data: {!! json_encode($totals) !!}, // Y-axis data (total sales)
                    backgroundColor: backgroundGradient, // Apply the gradient to the background
                    borderColor: lineGradient, // Apply the gradient to the line itself
                    borderWidth: 4,  // Line thickness
                    fill: true, // Fill the area under the line
                    lineTension: 0.3, // Smooth curve for the line
                    pointRadius: 5, // Size of the points on the line
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Color of points
                    pointBorderWidth: 3, // Border width of points
                    pointHoverRadius: 7, // Increase point size on hover
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)' // Hover effect color
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)', // Dark tooltip background
                        titleColor: '#fff',  // Tooltip title color
                        bodyColor: '#fff',  // Tooltip body color
                        borderColor: 'rgba(54, 162, 235, 1)', // Tooltip border color
                        borderWidth: 2,
                        padding: 10,
                        cornerRadius: 5,
                        callbacks: {
                            label: function(tooltipItem) {
                                return '₨ ' + tooltipItem.raw.toLocaleString(); // Format sales values with currency
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)', // Grid line color
                            borderColor: 'rgba(0, 0, 0, 0.1)' // Border line color for the graph
                        },
                        ticks: {
                            color: '#666', // Y-axis tick color
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)' // Grid line color
                        },
                        ticks: {
                            color: '#666', // X-axis tick color
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1200, // Duration for the animation
                    easing: 'easeOutBounce', // Easing for smooth animation
                    onComplete: function() {
                        // Additional actions after the animation is complete (if needed)
                    }
                },
                elements: {
                    line: {
                        borderWidth: 4, // Line thickness
                        borderColor: lineGradient, // Line color with gradient
                        fill: true
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
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
        const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');

        // Gradient for Monthly Sales Chart
        const monthlyLineGradient = ctxMonthly.createLinearGradient(0, 0, 0, 400);
        monthlyLineGradient.addColorStop(0, 'rgba(255, 99, 132, 1)'); // Red
        monthlyLineGradient.addColorStop(1, 'rgba(255, 159, 64, 1)'); // Orange

        const monthlyBackgroundGradient = ctxMonthly.createLinearGradient(0, 0, 0, 400);
        monthlyBackgroundGradient.addColorStop(0, 'rgba(255, 99, 132, 0.2)');
        monthlyBackgroundGradient.addColorStop(1, 'rgba(255, 159, 64, 0.2)');

        const monthlySalesChart = new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Monthly Sales',
                    data: {!! json_encode($monthlyTotals) !!},
                    backgroundColor: monthlyBackgroundGradient,
                    borderColor: monthlyLineGradient,
                    borderWidth: 4,
                    fill: true,
                    lineTension: 0.3,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointBorderWidth: 3,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: 'rgba(255, 159, 64, 1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        padding: 10,
                        cornerRadius: 5,
                        callbacks: {
                            label: function(tooltipItem) {
                                return '₨ ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                            borderColor: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: '#666',
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: '#666',
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeOutBounce'
                },
                elements: {
                    line: {
                        borderWidth: 4,
                        borderColor: monthlyLineGradient,
                        fill: true
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });

    </script>
@endsection
