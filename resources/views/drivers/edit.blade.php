@extends('adminlte::page')

@section('title', __('messages.edit_driver'))

@section('content_header')
    <h1>{{ __('messages.edit_driver') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('drivers.update', $driver) }}" method="POST">

            @method('PUT')

            @include('_form')

            <button type="submit" class="btn btn-success">
                {{ __('update_driver') }}
            </button>

            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
                {{ __('cancel') }}
            </a>

        </form>

    </div>
</div>

@stop