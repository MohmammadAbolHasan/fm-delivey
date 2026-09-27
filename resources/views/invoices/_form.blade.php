<div class="row">

    <div class="col-md-6 mb-3">
        <label>{{ __('invoice_number') }}</label>
        <input type="text"
               name="invoice_number"
               class="form-control"
               value="{{ old('invoice_number', $invoice->invoice_number ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('client') }}</label>

        <select name="client_id" class="form-control">

            <option value="">{{ __(' select_client') }}</option>

            @foreach($clients as $client)

                <option
                    value="{{ $client->id }}"
                    @selected(old('client_id', $invoice->client_id ?? '') == $client->id)
                >
                    {{ $client->name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('driver') }}</label>

        <select name="driver_id" class="form-control">

            <option value="">{{ __('select_driver') }}</option>

            @foreach($drivers as $driver)

                <option
                    value="{{ $driver->id }}"
                    @selected(old('driver_id', $invoice->driver_id ?? '') == $driver->id)
                >
                    {{ $driver->name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('receiver_name') }}</label>

        <input type="text"
               name="receiver_name"
               class="form-control"
               value="{{ old('receiver_name', $invoice->receiver_name ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('receiver_phone') }}</label>

        <input type="text"
               name="receiver_phone"
               class="form-control"
               value="{{ old('receiver_phone', $invoice->receiver_phone ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('amount') }}</label>

        <input type="number"
               step="0.01"
               name="amount"
               class="form-control"
               value="{{ old('amount', $invoice->amount ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('date') }}</label>

        <input type="date"
               name="invoice_date"
               class="form-control"
               value="{{ old('invoice_date', $invoice->invoice_date ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>{{ __('status') }}</label>

        <select name="status" class="form-control">

            @foreach(['Pending','Done','Rejected','Delayed'] as $status)

                <option
                    value="{{ $status }}"
                    @selected(old('status', $invoice->status ?? 'Pending') == $status)
                >
                    {{ __('message.' . strtolower($status)) }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label>{{ __('receiver_address') }}</label>

        <textarea
            name="receiver_address"
            class="form-control"
            rows="3">{{ old('receiver_address', $invoice->receiver_address ?? '') }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label>{{ __('notes') }}</label>

        <textarea
            name="notes"
            class="form-control"
            rows="3">{{ old('notes', $invoice->notes ?? '') }}</textarea>
    </div>

</div>

<button class="btn btn-success">
    {{ __('save_invoice') }}
</button>

<a href="{{ route('invoices.index') }}" class="btn btn-secondary">
    {{ __('cancel') }}
</a>