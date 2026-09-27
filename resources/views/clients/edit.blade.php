@extends('adminlte::page')

@section('title', __('edit_client'))

@section('content_header')
    <h1>{{ __('edit_client') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('clients.update', $client) }}" method="POST">

    @method('PUT')

    @include('clients._form')

    <button type="submit" class="btn btn-success">
        {{ __('update_client') }}
    </button>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
        {{ __('cancel') }}
    </a>

</form>
    </div>
</div>

@stop