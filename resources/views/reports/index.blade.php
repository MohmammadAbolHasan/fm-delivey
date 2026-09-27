@extends('adminlte::page')

@section('title', __('reports'))

@section('content_header')
    <h1>{{ __('reports') }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-2">
                    <input
                        type="date"
                        name="from"
                        class="form-control"
                        value="{{ request('from') }}">
                </div>

                <div class="col-md-2">
                    <input
                        type="date"
                        name="to"
                        class="form-control"
                        value="{{ request('to') }}">
                </div>

                <div class="col-md-2">

                    <select name="client" class="form-control">

                        <option value="">
                            {{ __('all_clients') }}
                        </option>

                        @foreach($clients as $client)

                            <option
                                value="{{ $client->id }}"
                                {{ request('client') == $client->id ? 'selected' : '' }}>

                                {{ $client->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <select name="driver" class="form-control">

                        <option value="">
                            {{ __('all_drivers') }}
                        </option>

                        @foreach($drivers as $driver)

                            <option
                                value="{{ $driver->id }}"
                                {{ request('driver') == $driver->id ? 'selected' : '' }}>

                                {{ $driver->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <select name="status" class="form-control">

                        <option value="">
                            {{ __('all_status') }}
                        </option>

                        <option value="Pending">
                            {{ __('pending') }}
                        </option>

                        <option value="Done">
                            {{ __('done') }}
                        </option>

                        <option value="Rejected">
                            {{ __('rejected') }}
                        </option>

                        <option value="Delayed">
                            {{ __('delayed') }}
                        </option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                        {{ __('search') }}
                    </button>

                </div>

            </div>

        </form>

        <hr>

        <h4>
            {{ __('total_revenue') }}:
            <strong>
                ${{ number_format($totalRevenue, 2) }}
            </strong>
        </h4>

        <table class="table table-bordered mt-3">

            <thead>

                <tr>

                    <th>{{ __('invoice') }}</th>
                    <th>{{ __('client') }}</th>
                    <th>{{ __('driver') }}</th>
                    <th>{{ __('status') }}</th>
                    <th>{{ __('amount') }}</th>

                </tr>

            </thead>

            <tbody>

            @forelse($invoices as $invoice)

                <tr>

                    <td>{{ $invoice->invoice_number }}</td>

                    <td>
                        {{ $invoice->client->name ?? '-' }}
                    </td>

                    <td>
                        {{ $invoice->driver->name ?? '-' }}
                    </td>

                    <td>

                        @switch($invoice->status)

                            @case('Pending')
                                <span class="badge bg-warning">
                                    {{ __('pending') }}
                                </span>
                                @break

                            @case('Done')
                                <span class="badge bg-success">
                                    {{ __('done') }}
                                </span>
                                @break

                            @case('Rejected')
                                <span class="badge bg-danger">
                                    {{ __('rejected') }}
                                </span>
                                @break

                            @case('Delayed')
                                <span class="badge bg-info">
                                    {{ __('delayed') }}
                                </span>
                                @break

                            @default
                                {{ $invoice->status }}

                        @endswitch

                    </td>

                    <td>
                        ${{ number_format($invoice->amount, 2) }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        {{ __('no_invoices_found') }}
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop