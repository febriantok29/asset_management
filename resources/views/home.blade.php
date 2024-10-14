@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <!-- Dashboard Heading -->
        <h1 class="my-4">Asset Management Dashboard</h1>

        <!-- Cards Section (Summary Data) -->
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Assets
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAssets }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Assets in Maintenance
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assetsInMaintenance }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Assets Under Repair
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assetsUnderRepair }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wrench fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Broken Assets
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $brokenAssets }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Asset Activity -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Asset Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentAssets as $asset)
                                <tr>
                                    <td>{{ $asset->name }}</td>
                                    @php
                                        $statusClass = 'bg-success';
                                        if ($asset->status == 'broken') {
                                            $statusClass = 'bg-danger';
                                        } elseif ($asset->status == 'repair') {
                                            $statusClass = 'bg-warning';
                                        }
                                    @endphp
                                    <td>
                                        <span class="badge {{ $statusClass }}">{{ ucfirst($asset->status) }}</span>
                                    </td>
                                    <td>{{ $asset->updated_at }}</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
