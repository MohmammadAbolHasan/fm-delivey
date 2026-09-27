<div class="col-md-2 bg-light min-vh-100">

    <div class="list-group mt-3">

        <a href="{{ route('dashboard') }}" class="list-group-item">
            {{ __('dashboard') }}
        </a>

        <a href="{{ route('clients.index') }}" class="list-group-item">
            {{ __('clients') }}
        </a>

        <a href="{{ route('drivers.index') }}" class="list-group-item">
            {{ __(' drivers') }}
        </a>

        <a href="{{ route('invoices.index') }}" class="list-group-item">
            {{ __('invoices') }}
        </a>

    </div>

</div>