@extends('adminlte::page')

@section('title', __('clients'))

@section('content_header')
    <h1>{{ __('clients') }}</h1>
@stop

@section('content')

<a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> {{ __('add_client') }}
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
                    <th>{{ __('client_name') }}</th>
                    <th>{{ __('client_type') }}</th>
                    <th>{{ __('phone') }}</th>
                    <th>{{ __('status') }}</th>
                    <th width="180">{{ __('actions') }}</th>
                </tr>
            </thead>

            <tbody>

            @forelse($clients as $client)

                <tr>

                    <td>{{ $client->name }}</td>

                    <td>   @if($client->type == 'Restaurant')
                             {{ __('restaurant') }}
                           @else
                             {{ __('shop') }}
                           @endif
                    </td>

                    <td>{{ $client->phone }}</td>

                    <td>
                        @if($client->is_active)
                            <span class="badge bg-success">{{ __('active') }}</span>
                        @else
                            <span class="badge bg-danger">{{ __('inactive') }}</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('clients.edit', $client) }}"
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('clients.destroy', $client) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('{{ __('confirm_delete') }}')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        {{ __('no_clients_found') }}
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $clients->links() }}
        </div>

    </div>
</div>

@stop