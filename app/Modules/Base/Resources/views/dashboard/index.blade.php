@extends('base::components.dashboard.layouts.master')

@section('title')
    {{ __('dashboard.dashboard') }}
@endsection

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            padding: 20px 25px;
            border-radius: 10px;
            min-width: 160px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            max-width: 600px;
            margin: 0 auto;
            height: 450px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- Dashboard content start -->
                <div class="product-details-wrapper">



                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Pie chart for ads status
        const labels = ['{{ __('ads.active') }}', '{{ __('ads.pending') }}', '{{ __('ads.rejected') }}', '{{ __('ads.expired') }}'];
        const counts = [{{ $activeAds }}, {{ $pendingAds }}, {{ $rejectedAds }}, {{ $expiredAds }}];

        const colors = [
            'rgba(186, 225, 255, 0.7)',  // Active
            'rgba(255, 223, 186, 0.7)',  // Pending
            'rgba(255, 179, 186, 0.7)',  // Rejected
            'rgba(200, 200, 200, 0.7)'   // Expired
        ];

        new Chart(document.getElementById('adsStatusPieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: '{{ __("dashboard.total_ads") }}',
                    data: counts,
                    backgroundColor: colors,
                    borderColor: colors.map(c => c.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'bottom' }
                }
            }
        });
    </script>
@endsection