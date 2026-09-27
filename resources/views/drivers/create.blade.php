@extends('adminlte::page')

@section('title', __('messages.add_driver'))

@section('content_header')
    <h1>{{ __('messages.add_driver') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('drivers.store') }}" method="POST">

            @include('drivers._form')

            <button type="submit" class="btn btn-primary">
                {{ __('save_driver') }}
            </button>

            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
                {{ __('cancel') }}
            </a>

        </form>

    </div>
</div>

@stop