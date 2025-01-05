@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="jumbotron text-center bg-light p-5 rounded shadow-sm">
            <h1 class="display-4">Selamat Datang di Manajemen Aset</h1>
            <p class="lead">Website Management Aset ini dibuat oleh <a href="#">Kelompok 3</a> untuk memenuhi tugas
                besar mata kuliah Pemrograman Web Lanjut, yang diampu oleh Bapak <a href="#">Sandy</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-boxes fa-2x mr-2"></i>
                        <span>Total Aset</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $totalAssets }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-truck fa-2x mr-2"></i>
                        <span>Total Vendor</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $totalVendors }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3 shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-shopping-cart fa-2x mr-2"></i>
                        <span>Total Pembelian</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $totalPurchases }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-chart-pie fa-2x mr-2"></i>
                        <span>Aset Berdasarkan Kategori</span>
                    </div>
                    <div class="card-body">
                        <canvas id="assetsByCategoryChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-chart-bar fa-2x mr-2"></i>
                        <span>Pembelian Berdasarkan Bulan</span>
                    </div>
                    <div class="card-body">
                        <canvas id="purchasesByMonthChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var assetsByCategoryCtx = document.getElementById('assetsByCategoryChart').getContext('2d');
            var assetsByCategoryChart = new Chart(assetsByCategoryCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($assetsByCategoryLabels) !!},
                    datasets: [{
                        data: {!! json_encode($assetsByCategoryData) !!},
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                    }]
                }
            });

            var purchasesByMonthCtx = document.getElementById('purchasesByMonthChart').getContext('2d');
            var purchasesByMonthChart = new Chart(purchasesByMonthCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($purchasesByMonthLabels) !!},
                    datasets: [{
                        label: 'Pembelian',
                        data: {!! json_encode($purchasesByMonthData) !!},
                        backgroundColor: '#36A2EB'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
