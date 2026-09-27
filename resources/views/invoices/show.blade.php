@extends('adminlte::page')

@section('title', __('invoice_details'))

@section('content_header')
    <h1>{{ __('invoice_details') }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3>{{ __('invoice') }} #{{ $invoice->invoice_number }}</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">{{ __('client') }}</th>
                <td>{{ $invoice->client->name }}</td>
            </tr>

            <tr>
                <th>{{ __('driver') }}</th>
                <td>{{ $invoice->driver->name }}</td>
            </tr>

            <tr>
                <th>{{ __('receiver_name') }}</th>
                <td>{{ $invoice->receiver_name }}</td>
            </tr>

            <tr>
                <th>{{ __('receiver_phone') }}</th>
                <td>{{ $invoice->receiver_phone }}</td>
            </tr>

            <tr>
                <th>{{ __('receiver_address') }}</th>
                <td>{{ $invoice->receiver_address }}</td>
            </tr>

            <tr>
                <th>{{ __('amount') }}</th>
                <td>${{ number_format($invoice->amount,2) }}</td>
            </tr>

            <tr>
                <th>{{ __('status') }}</th>
                <td>{{ $invoice->status }}</td>
            </tr>

            <tr>
                <th>{{ __('invoice_date') }}</th>
                <td>{{ $invoice->invoice_date }}</td>
            </tr>

            <tr>
                <th>{{ __('notes') }}</th>
                <td>{{ $invoice->notes ?? '-' }}</td>
            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a href="{{ route('invoices.index') }}"
           class="btn btn-secondary">
            {{ __('back_to_invoices') }}
        </a>

        <a href="{{ route('invoices.edit',$invoice) }}"
           class="btn btn-warning">
            {{ __('edit_invoice') }}
        </a>
        <a href="{{ route('invoices.pdf', $invoice) }}"
   class="btn btn-danger"
   target="_blank">

    <i class="fas fa-file-pdf"></i>
    Download PDF

</a>

    </div>

</div>

@stop