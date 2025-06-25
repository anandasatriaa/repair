@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        .chart-wrapper {
            height: 300px;
            position: relative;
        }
    </style>
@endsection

@section('content')

    @php
        function getBadgeClass($category)
        {
            return match ($category) {
                'CTEK' => 'bg-dark',
                'NOCO' => 'bg-info',
                'RUPES' => 'bg-danger',
                default => 'bg-secondary',
            };
        }
    @endphp
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            {{-- Permintaan Service --}}
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                    style="border-left: 5px solid #e3001c;">
                    <i class="fa fa-tools fa-3x text-primary"></i>
                    <div class="ms-3 w-100">
                        <p class="mb-2">Permintaan Service</p>
                        <h4 class="mb-0">{{ $totalAll }}</h4>
                        <div class="mt-2">
                            @foreach ($categories as $cat)
                                <span class="badge {{ getBadgeClass($cat) }} me-1">
                                    {{ $cat }}: {{ $byCategoryAll[$cat] ?? 0 }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status ON PROGRESS --}}
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                    style="border-left: 5px solid #e3001c;">
                    <i class="fa fa-hourglass-half fa-3x text-primary"></i>
                    <div class="ms-3 w-100">
                        <p class="mb-2">Status ON PROGRESS</p>
                        <h4 class="mb-0">{{ $totalOnProg }}</h4>
                        <div class="mt-2">
                            @foreach ($categories as $cat)
                                <span class="badge {{ getBadgeClass($cat) }} me-1">
                                    {{ $cat }}: {{ $byCategoryOn[$cat] ?? 0 }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status DONE --}}
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                    style="border-left: 5px solid #e3001c;">
                    <i class="fa fa-check-circle fa-3x text-primary"></i>
                    <div class="ms-3 w-100">
                        <p class="mb-2">Status DONE</p>
                        <h4 class="mb-0">{{ $totalDone }}</h4>
                        <div class="mt-2">
                            @foreach ($categories as $cat)
                                <span class="badge {{ getBadgeClass($cat) }} me-1">
                                    {{ $cat }}: {{ $byCategoryDone[$cat] ?? 0 }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <!-- Chart Kategori -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded p-4">
                    <h6>Permintaan Service per Kategori</h6>
                    <div class="chart-wrapper">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Chart Tipe Service -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded p-4">
                    <h6>Tipe Service Terbanyak</h6>
                    <div class="chart-wrapper">
                        <canvas id="typeServiceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Charts End -->
@endsection

@section('scripts')
<script>
    Chart.register(ChartDataLabels); // Register plugin secara global

    document.addEventListener('DOMContentLoaded', function () {
        const catLabels = @json($chartCatLabels);
        const catData = @json($chartCatData);
        const typeLabels = @json($chartTypeLabels);
        const typeData = @json($chartTypeData);

        // Palet merah untuk bar chart kategori
        const redShades = {
            'CTEK': '#ff4d4d',       // merah terang
            'NOCO': '#e60000',       // merah sedang
            'RUPES': '#b30000'       // merah gelap
        };

        // 1) Bar chart kategori
        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: catLabels,
                datasets: [{
                    label: 'Jumlah Permintaan',
                    data: catData,
                    backgroundColor: catLabels.map(cat => redShades[cat] ?? '#ff9999') // fallback merah soft
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Kategori'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Permintaan'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Palet merah untuk donut chart
        const donutRedColors = ['#ff4d4d', '#e60000', '#b30000', '#ff9999'];

        // 2) Doughnut chart tipe service
        new Chart(document.getElementById('typeServiceChart'), {
            type: 'doughnut',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: typeLabels.map((_, idx) => donutRedColors[idx % donutRedColors.length])
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    datalabels: {
                        formatter: (value) => value,
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

@endsection
