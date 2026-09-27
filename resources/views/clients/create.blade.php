@extends('adminlte::page')

@section('title', __('add_client'))

@section('content_header')
    <h1>{{ __('add_client') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('clients.store') }}" method="POST">

            @include('clients._form')

            <button type="submit" class="btn btn-primary">
                {{ __('save') }}
            </button>

            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                {{ __('cancel') }}
            </a>

        </form>

    </div>
</div>

@stop