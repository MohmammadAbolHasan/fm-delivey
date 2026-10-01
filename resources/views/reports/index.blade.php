@extends('adminlte::page')

@section('title', __('reports'))

@section('content_header')
    <h1>{{ __('reports') }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        {{-- Filters --}}
        <form method="GET">

            <div class="row">

                {{-- From Date --}}
                <div class="col-md-2 mb-2">
                    <label>From Date</label>

                    <input
                        type="date"
                        name="from"
                        class="form-control"
                        value="{{ request('from') }}">
                </div>

                {{-- To Date --}}
                <div class="col-md-2 mb-2">
                    <label>To Date</label>

                    <input
                        type="date"
                        name="to"
                        class="form-control"
                        value="{{ request('to') }}">
                </div>

                {{-- Client --}}
                <div class="col-md-2 mb-2">
                    <label>{{ __('client') }}</label>

                    <select name="client" class="form-control">

                        <option value="">
                            {{ __('all_clients') }}
                        </option>

                        @foreach($clients as $client)

                            <option
                                value="{{ $client->id }}"
                                @selected(request('client') == $client->id)
                            >
                                {{ $client->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Driver --}}
                <div class="col-md-2 mb-2">
                    <label>{{ __('driver') }}</label>

                    <select name="driver" class="form-control">

                        <option value="">
                            {{ __('all_drivers') }}
                        </option>

                        @foreach($drivers as $driver)

                            <option
                                value="{{ $driver->id }}"
                                @selected(request('driver') == $driver->id)
                            >
                                {{ $driver->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-2 mb-2">
                    <label>{{ __('status') }}</label>

                    <select name="status" class="form-control">

                        <option value="">
                            {{ __('all_status') }}
                        </option>

                        <option
                            value="Pending"
                            @selected(request('status') == 'Pending')
                        >
                            {{ __('pending') }}
                        </option>

                        <option
                            value="Done"
                            @selected(request('status') == 'Done')
                        >
                            {{ __('done') }}
                        </option>

                        <option
                            value="Rejected"
                            @selected(request('status') == 'Rejected')
                        >
                            {{ __('rejected') }}
                        </option>

                        <option
                            value="Delayed"
                            @selected(request('status') == 'Delayed')
                        >
                            {{ __('delayed') }}
                        </option>

                    </select>
                </div>

                {{-- Search Button --}}
                <div class="col-md-2 mb-2">
                    <label>&nbsp;</label>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        <i class="fas fa-search"></i>
                        {{ __('search') }}

                    </button>
                </div>

            </div>

        </form>

        <hr>


        {{-- Totals --}}
        <div class="row">

            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">

                        <strong>Amount</strong>

                        <h4 class="mt-2 mb-0">
                            ${{ number_format($totalGoodsAmount, 2) }}
                        </h4>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">

                        <strong>Delivery Amount</strong>

                        <h4 class="mt-2 mb-0">
                            ${{ number_format($totalDeliveryAmount, 2) }}
                        </h4>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">

                        <strong>Total Amount</strong>

                        <h4 class="mt-2 mb-0">
                            ${{ number_format($grandTotal, 2) }}
                        </h4>

                    </div>
                </div>
            </div>

        </div>


        {{-- Invoices Table --}}
        <table class="table table-bordered table-hover mt-3">

            <thead>

                <tr>

                    <th>{{ __('invoice') }}</th>

                    <th>{{ __('date') }}</th>

                    <th>{{ __('client') }}</th>

                    <th>{{ __('driver') }}</th>

                    <th>{{ __('status') }}</th>

                    <th>Amount</th>

                    <th>Delivery Amount</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

            @forelse($invoices as $invoice)

                <tr>

                    {{-- Invoice --}}
                    <td>
                        {{ $invoice->invoice_number }}
                    </td>

                    {{-- Date --}}
                    <td>
                        {{ $invoice->invoice_date }}
                    </td>

                    {{-- Client --}}
                    <td>
                        {{ $invoice->client->name ?? '-' }}
                    </td>

                    {{-- Driver --}}
                    <td>
                        {{ $invoice->driver->name ?? '-' }}
                    </td>

                    {{-- Status --}}
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

                    {{-- Goods Amount --}}
                    <td>
                        ${{ number_format($invoice->amount ?? 0, 2) }}
                    </td>

                    {{-- Delivery Amount --}}
                    <td>
                        ${{ number_format($invoice->driver_amount ?? 0, 2) }}
                    </td>

                    {{-- Total Invoice --}}
                    <td>
                        <strong>
                            ${{ number_format(
                                ($invoice->amount ?? 0)
                                +
                                ($invoice->driver_amount ?? 0),
                                2
                            ) }}
                        </strong>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="8" class="text-center">
                        {{ __('no_invoices_found') }}
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop