@extends('adminlte::page')

@section('title', __('edit_invoice'))

@section('content_header')
    <h1>{{ __('edit_invoice') }}</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">{{ __('edit_invoice') }}</h3>
    </div>

    <form action="{{ route('invoices.update', $invoice) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            @include('invoices._form')

        </div>

    </form>

</div>

@stop