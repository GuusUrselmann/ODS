@extends('adminlte::page')
@section('plugins.Chartjs', true)
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sales</h3>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                </p>
            </div>
            <div class="position-relative mb-4">
                <canvas id="ChartSales" height="200"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                </span>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script>
        var ctx = document.getElementById('ChartSales').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN'],
                datasets: [{
                    label: 'Sales this year',
                    data: [1200, 1936.50, 337.23, 500, 2284.19, 329.70],
                    backgroundColor: [
                        'rgb(54, 89, 193)',
                        'rgb(54, 89, 193)',
                        'rgb(54, 89, 193)',
                        'rgb(54, 89, 193)',
                        'rgb(54, 89, 193)',
                        'rgb(54, 89, 193)'
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@stop
