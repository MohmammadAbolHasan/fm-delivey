@extends('adminlte::page')

@section('title', __('invoices'))

@section('content_header')
    <h1>{{ __('invoices') }}</h1>
@stop

@section('content')

<a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i>
    {{ __('add_invoice') }}
</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="GET"
      action="{{ route('invoices.index') }}"
      class="mb-3">

    <div class="row">

        <div class="col-md-6 mb-2">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="{{ __('search_invoices') }}"
                value="{{ request('search') }}">
        </div>

        <div class="col-md-4 mb-2">
            <input
                type="date"
                name="date"
                class="form-control"
                value="{{ request('date') }}">
        </div>

        <div class="col-md-2 mb-2">
            <button type="submit"
                    class="btn btn-primary w-100">

                <i class="fas fa-search"></i>
                {{ __('search') }}

            </button>
        </div>

    </div>

</form>
<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>#</th>
                    <th>{{ __('invoice') }}</th>
                    <th>{{ __('client') }}</th>
                    <th>{{ __('driver') }}</th>
                    <th>{{ __('receiver') }}</th>
                    <th>{{ __('Goods Amount') }}</th>
                    <th>{{ __('Driver Amount') }}</th>
                    <th>{{ __('status') }}</th>
                    <th>{{ __('date') }}</th>
                    <th style="min-width: 220px;">
                        {{ __('actions') }}
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($invoices as $invoice)

                <tr>

                    <td>{{ $invoice->id }}</td>

                    <td>{{ $invoice->invoice_number }}</td>

                    <td>{{ $invoice->client->name ?? '-' }}</td>

                    <td>{{ $invoice->driver->name ?? '-' }}</td>

                    <td>{{ $invoice->receiver_name }}</td>

                    <td>
                        ${{ number_format($invoice->amount, 2) }}
                    </td>
                    <td>
                        ${{ number_format($invoice->driver_amount ?? 0, 2) }}
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

                        @endswitch

                    </td>

                    <td>{{ $invoice->invoice_date }}</td>

                    <td style="min-width: 220px;">

                        {{-- Main Actions --}}
                        <div class="d-flex flex-wrap gap-1 mb-2">

                            <a href="{{ route('invoices.show', $invoice) }}"
                               class="btn btn-info btn-sm"
                               title="{{ __('view') }}">

                                <i class="fas fa-eye"></i>
                                {{ __('view') }}

                            </a>

                            <a href="{{ route('invoices.edit', $invoice) }}"
                               class="btn btn-warning btn-sm"
                               title="{{ __('edit') }}">

                                <i class="fas fa-edit"></i>
                                {{ __('edit') }}

                            </a>

                            <form action="{{ route('invoices.destroy', $invoice) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('{{ __('delete_invoice_confirm') }}')"
                                    class="btn btn-secondary btn-sm"
                                    title="{{ __('delete') }}">

                                    <i class="fas fa-trash"></i>
                                    {{ __('delete') }}

                                </button>

                            </form>

                        </div>

                        {{-- Status Actions --}}
                        <div class="d-flex flex-wrap gap-1">

                            <form action="{{ route('invoices.changeStatus', [$invoice, 'Done']) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                    title="{{ __('done') }}">

                                    <i class="fas fa-check"></i>

                                </button>

                            </form>

                            <form action="{{ route('invoices.changeStatus', [$invoice, 'Rejected']) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="{{ __('rejected') }}">

                                    <i class="fas fa-times"></i>

                                </button>

                            </form>

                            <form action="{{ route('invoices.changeStatus', [$invoice, 'Pending']) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-warning btn-sm"
                                    title="{{ __('pending') }}">

                                    <i class="fas fa-clock"></i>

                                </button>

                            </form>

                            <form action="{{ route('invoices.changeStatus', [$invoice, 'Delayed']) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-info btn-sm"
                                    title="{{ __('delayed') }}">

                                    <i class="fas fa-hourglass-half"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">
                        {{ __('no_invoices_found') }}
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $invoices->links() }}

    </div>

</div>

@stop