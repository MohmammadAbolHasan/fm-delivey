@extends('adminlte::page')

@section('title', __('dashboard'))

@section('content_header')

    <div class="dashboard-header">
        <div>
            <h1 class="mb-1">{{ __('dashboard') }}</h1>

            <p class="text-muted mb-0">
                {{ __('app_name') }}
            </p>
        </div>
    </div>

@stop


@section('content')

{{-- =========================================================
     MAIN STATISTICS
========================================================= --}}

<div class="row">

    {{-- Clients --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">

        <div class="small-box dashboard-box bg-primary">

            <div class="inner">

                <p>{{ __('clients') }}</p>

                <h3>{{ $clients }}</h3>

                <span class="stat-label">
                    Registered clients
                </span>

            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>

            <a href="{{ route('clients.index') }}"
               class="small-box-footer">

                {{ __('more_info') }}

                <i class="fas fa-arrow-circle-right ml-1"></i>

            </a>

        </div>

    </div>


    {{-- Drivers --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">

        <div class="small-box dashboard-box bg-secondary">

            <div class="inner">

                <p>{{ __('drivers') }}</p>

                <h3>{{ $drivers }}</h3>

                <span class="stat-label">
                    Active delivery team
                </span>

            </div>

            <div class="icon">
                <i class="fas fa-truck"></i>
            </div>

            <a href="{{ route('drivers.index') }}"
               class="small-box-footer">

                {{ __('more_info') }}

                <i class="fas fa-arrow-circle-right ml-1"></i>

            </a>

        </div>

    </div>


    {{-- Total Invoices --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">

        <div class="small-box dashboard-box bg-info">

            <div class="inner">

                <p>{{ __('total_invoices') }}</p>

                <h3>{{ $invoices }}</h3>

                <span class="stat-label">
                    All delivery invoices
                </span>

            </div>

            <div class="icon">
                <i class="fas fa-file-invoice"></i>
            </div>

            <a href="{{ route('invoices.index') }}"
               class="small-box-footer">

                {{ __('more_info') }}

                <i class="fas fa-arrow-circle-right ml-1"></i>

            </a>

        </div>

    </div>


    {{-- Pending --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">

        <div class="small-box dashboard-box bg-warning">

            <div class="inner">

                <p>{{ __('pending') }}</p>

                <h3>{{ $pending }}</h3>

                <span class="stat-label">
                    Waiting for action
                </span>

            </div>

            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     ORDER STATUS
========================================================= --}}

<div class="row">

    {{-- Done --}}
    <div class="col-xl-4 col-md-6 col-12">

        <div class="info-box dashboard-info-box">

            <span class="info-box-icon bg-success">
                <i class="fas fa-check"></i>
            </span>

            <div class="info-box-content">

                <span class="info-box-text">
                    {{ __('done') }}
                </span>

                <span class="info-box-number">
                    {{ $done }}
                </span>

                <span class="progress-description">
                    Successfully completed
                </span>

            </div>

        </div>

    </div>


    {{-- Rejected --}}
    <div class="col-xl-4 col-md-6 col-12">

        <div class="info-box dashboard-info-box">

            <span class="info-box-icon bg-danger">
                <i class="fas fa-times"></i>
            </span>

            <div class="info-box-content">

                <span class="info-box-text">
                    {{ __('rejected') }}
                </span>

                <span class="info-box-number">
                    {{ $rejected }}
                </span>

                <span class="progress-description">
                    Rejected invoices
                </span>

            </div>

        </div>

    </div>


    {{-- Delayed --}}
    <div class="col-xl-4 col-md-12 col-12">

        <div class="info-box dashboard-info-box">

            <span class="info-box-icon bg-dark">
                <i class="fas fa-hourglass-half"></i>
            </span>

            <div class="info-box-content">

                <span class="info-box-text">
                    {{ __('delayed') }}
                </span>

                <span class="info-box-number">
                    {{ $delayed }}
                </span>

                <span class="progress-description">
                    Delivery requires attention
                </span>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MONEY TOTALS
========================================================= --}}

<div class="row">

    {{-- Items Amount --}}
    <div class="col-md-6 col-12">

        <div class="money-summary-card">

            <div class="money-summary-icon items-icon">
                <i class="fas fa-box"></i>
            </div>

            <div class="money-summary-content">

                <span class="money-summary-label">
                    Items Amount
                </span>

                <h3>
                    ${{ number_format($totalItemsAmount ?? 0, 2) }}
                </h3>

                <small class="text-muted">
                    Total items money from completed invoices
                </small>

            </div>

        </div>

    </div>


    {{-- Delivery Amount --}}
    <div class="col-md-6 col-12">

        <div class="money-summary-card">

            <div class="money-summary-icon delivery-icon">
                <i class="fas fa-truck"></i>
            </div>

            <div class="money-summary-content">

                <span class="money-summary-label">
                    Delivery Amount
                </span>

                <h3>
                    ${{ number_format($totalDeliveryAmount ?? 0, 2) }}
                </h3>

                <small class="text-muted">
                    Total delivery money from completed invoices
                </small>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DRIVER PERFORMANCE
========================================================= --}}

<div class="card dashboard-card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="card-title font-weight-bold mb-1">

                    <i class="fas fa-chart-line mr-2 text-primary"></i>

                    {{ __('drivers_performance') }}

                </h3>

                <small class="text-muted">
                    Delivery performance overview
                </small>

            </div>

        </div>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover dashboard-table mb-0">

                <thead>

                    <tr>

                        <th>
                            {{ __('driver_name') }}
                        </th>

                        <th>
                            {{ __('done_orders') }}
                        </th>

                        <th>
                            Items Amount
                        </th>

                        <th>
                            Delivery Amount
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($driverStats as $driver)

                    <tr>

                        {{-- Driver --}}
                        <td>

                            <div class="driver-name">

                                <span class="driver-icon">
                                    <i class="fas fa-user"></i>
                                </span>

                                <strong>
                                    {{ $driver->name }}
                                </strong>

                            </div>

                        </td>


                        {{-- Done Orders --}}
                        <td>

                            <span class="orders-badge">
                                {{ $driver->done_orders }}
                            </span>

                        </td>


                        {{-- Items Amount --}}
                        <td>

                            <strong class="money-value">

                                ${{ number_format(
                                    $driver->items_amount ?? 0,
                                    2
                                ) }}

                            </strong>

                        </td>


                        {{-- Delivery Amount --}}
                        <td>

                            <strong class="money-value">

                                ${{ number_format(
                                    $driver->delivery_amount ?? 0,
                                    2
                                ) }}

                            </strong>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center py-4 text-muted">

                            {{ __('no_drivers_found') }}

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@stop


@section('css')

<style>

/* =========================================================
   Dashboard Header
========================================================= */

.dashboard-header {
    margin-bottom: 20px;
}

.dashboard-header h1 {
    font-size: 28px;
    font-weight: 700;
}


/* =========================================================
   Main Boxes
========================================================= */

.dashboard-box {
    border-radius: 12px;
    overflow: hidden;
    min-height: 145px;
    margin-bottom: 20px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.2s ease;
}

.dashboard-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 18px rgba(0, 0, 0, 0.12);
}

.dashboard-box .inner {
    padding: 20px;
}

.dashboard-box .inner p {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 5px;
}

.dashboard-box .inner h3 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 3px;
}

.dashboard-box .stat-label {
    font-size: 12px;
    opacity: 0.85;
}

.dashboard-box .icon {
    top: 15px;
    right: 15px;
}

.dashboard-box .icon i {
    font-size: 60px;
    opacity: 0.18;
}

.dashboard-box .small-box-footer {
    padding: 10px 15px;
    font-size: 13px;
    font-weight: 600;
}


/* =========================================================
   Status Boxes
========================================================= */

.dashboard-info-box {
    min-height: 105px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 20px;
    border: 1px solid #eeeeee;
}

.dashboard-info-box .info-box-icon {
    width: 90px;
}

.dashboard-info-box .info-box-number {
    font-size: 25px;
    font-weight: 700;
}

.dashboard-info-box .info-box-text {
    font-size: 14px;
    font-weight: 600;
}

.dashboard-info-box .progress-description {
    font-size: 12px;
    color: #888;
}


/* =========================================================
   Money Summary
========================================================= */

.money-summary-card {
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    min-height: 120px;
    border: 1px solid #eeeeee;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
}

.money-summary-icon {
    width: 65px;
    height: 65px;
    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 18px;

    font-size: 25px;
}

.items-icon {
    background: #e8f4ff;
    color: #007bff;
}

.delivery-icon {
    background: #e9f7ef;
    color: #28a745;
}

.money-summary-content {
    flex: 1;
}

.money-summary-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    margin-bottom: 3px;
}

.money-summary-content h3 {
    font-size: 27px;
    font-weight: 700;
    margin: 0 0 3px;
}


/* =========================================================
   Driver Performance
========================================================= */

.dashboard-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.07);
    overflow: hidden;
}

.dashboard-card .card-header {
    background: #ffffff;
    padding: 18px 20px;
    border-bottom: 1px solid #eeeeee;
}

.dashboard-table thead th {
    background: #f8f9fa;
    font-size: 13px;
    font-weight: 700;
    padding: 14px 18px;
    white-space: nowrap;
}

.dashboard-table tbody td {
    padding: 15px 18px;
    vertical-align: middle;
}

.driver-name {
    display: flex;
    align-items: center;
    gap: 10px;
}

.driver-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #f1f3f5;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    color: #6c757d;
}

.orders-badge {
    display: inline-block;
    min-width: 35px;
    padding: 5px 10px;

    border-radius: 20px;

    background: #e9f7ef;
    color: #28a745;

    font-weight: 700;
    text-align: center;
}

.money-value {
    font-size: 15px;
}


/* =========================================================
   Mobile
========================================================= */

@media (max-width: 767.98px) {

    .content-header {
        padding: 15px 15px 5px !important;
    }

    .content {
        padding: 10px !important;
    }

    .dashboard-header h1 {
        font-size: 23px;
    }

    .dashboard-box {
        min-height: 125px;
        margin-bottom: 15px;
    }

    .dashboard-box .inner {
        padding: 16px;
    }

    .dashboard-box .inner h3 {
        font-size: 27px;
    }

    .dashboard-box .icon i {
        font-size: 48px;
    }

    .dashboard-info-box {
        margin-bottom: 15px;
    }

    .money-summary-card {
        padding: 16px;
        min-height: 105px;
    }

    .money-summary-icon {
        width: 55px;
        height: 55px;
        font-size: 21px;
    }

    .money-summary-content h3 {
        font-size: 23px;
    }

    .dashboard-card .card-header {
        padding: 15px;
    }

    .dashboard-table {
        min-width: 700px;
    }

    .dashboard-table thead th,
    .dashboard-table tbody td {
        padding: 12px;
    }

}

</style>

@stop