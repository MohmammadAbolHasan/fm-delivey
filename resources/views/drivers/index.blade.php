@extends('adminlte::page')

@section('title', __('drivers'))

@section('content_header')
    <h1>{{ __('drivers') }}</h1>
@stop

@section('content')

<a href="{{ route('drivers.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> {{ __('add_driver') }}
</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>{{ __('driver_name') }}</th>
                    <th>{{ __('driver_phone') }}</th>
                    <th>{{ __('car') }}</th>
                    <th>{{ __('plate_number') }}</th>
                    <th>{{ __('status') }}</th>
                    <th width="180">{{ __('actions') }}</th>
                </tr>
            </thead>

            <tbody>

            @forelse($drivers as $driver)

                <tr>

                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>{{ $driver->car }}</td>
                    <td>{{ $driver->plate_number }}</td>

                    <td>
                        @if($driver->is_active)
                            <span class="badge bg-success">
                                {{ __('active') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('inactive') }}
                            </span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('drivers.edit', $driver) }}"
                           class="btn btn-sm btn-warning"
                           title="{{ __('edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('drivers.destroy', $driver) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                title="{{ __('delete') }}"
                                onclick="return confirm('{{ __('confirm_delete_driver') }}')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        {{ __('no_drivers_found') }}
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $drivers->links() }}
        </div>

    </div>
</div>

@stop