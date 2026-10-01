<div class="row">

    {{-- Invoice Number --}}
    <div class="col-md-6 mb-3">
        <label>{{ __('invoice_number') }}</label>

        <input
            type="text"
            name="invoice_number"
            class="form-control"
            value="{{ old('invoice_number', $invoice->invoice_number ?? '') }}"
        >
    </div>


    {{-- Client --}}
    <div class="col-md-6 mb-3">
        <label>{{ __('client') }}</label>

        <select name="client_id" class="form-control">

            <option value="">
                {{ __('select_client') }}
            </option>

            @foreach($clients as $client)

                <option
                    value="{{ $client->id }}"
                    @selected(
                        old('client_id', $invoice->client_id ?? '') == $client->id
                    )
                >
                    {{ $client->name }}
                </option>

            @endforeach

        </select>
    </div>


    {{-- Driver --}}
    <div class="col-md-6 mb-3">

        <label>
            {{ __('driver') }}
            <small class="text-muted">
                (Optional)
            </small>
        </label>

        <select name="driver_id" class="form-control">

            <option value="">
                {{ __('select_driver') }}
            </option>

            @foreach($drivers as $driver)

                <option
                    value="{{ $driver->id }}"
                    @selected(
                        old('driver_id', $invoice->driver_id ?? '') == $driver->id
                    )
                >
                    {{ $driver->name }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- Receiver Name --}}
    <div class="col-md-6 mb-3">

        <label>{{ __('receiver_name') }}</label>

        <input
            type="text"
            name="receiver_name"
            class="form-control"
            value="{{ old('receiver_name', $invoice->receiver_name ?? '') }}"
        >

    </div>


    {{-- Receiver Phone --}}
    <div class="col-md-6 mb-3">

        <label>{{ __('receiver_phone') }}</label>

        <input
            type="text"
            name="receiver_phone"
            class="form-control"
            value="{{ old('receiver_phone', $invoice->receiver_phone ?? '') }}"
        >

    </div>


    {{-- Goods Amount --}}
    <div class="col-md-6 mb-3">

        <label>Goods Amount</label>

        <input
            type="number"
            name="amount"
            step="0.01"
            min="0"
            class="form-control"
            value="{{ old('amount', $invoice->amount ?? 0) }}"
        >

    </div>


    {{-- Driver Amount --}}
    <div class="col-md-6 mb-3">

        <label>Driver Amount</label>

        <input
            type="number"
            name="driver_amount"
            step="0.01"
            min="0"
            class="form-control"
            value="{{ old('driver_amount', $invoice->driver_amount ?? 0) }}"
        >

    </div>


    {{-- Date --}}
    <div class="col-md-6 mb-3">

        <label>{{ __('date') }}</label>

        <input
            type="date"
            name="invoice_date"
            class="form-control"
            value="{{ old('invoice_date', $invoice->invoice_date ?? '') }}"
        >

    </div>


    {{-- Status --}}
    <div class="col-md-6 mb-3">

        <label>{{ __('status') }}</label>

        <select name="status" class="form-control">

            @foreach(['Pending', 'Done', 'Rejected', 'Delayed'] as $status)

                <option
                    value="{{ $status }}"
                    @selected(
                        old('status', $invoice->status ?? 'Pending') == $status
                    )
                >
                    {{ __(strtolower($status)) }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- Receiver Address --}}
    <div class="col-md-12 mb-3">

        <label>{{ __('receiver_address') }}</label>

        <textarea
            name="receiver_address"
            class="form-control"
            rows="3"
        >{{ old('receiver_address', $invoice->receiver_address ?? '') }}</textarea>

    </div>


    {{-- Notes --}}
    <div class="col-md-12 mb-3">

        <label>{{ __('notes') }}</label>

        <textarea
            name="notes"
            class="form-control"
            rows="3"
        >{{ old('notes', $invoice->notes ?? '') }}</textarea>

    </div>

</div>


{{-- Buttons --}}
<button
    type="submit"
    class="btn btn-success"
>
    <i class="fas fa-save"></i>
    {{ __('save_invoice') }}
</button>


<a
    href="{{ route('invoices.index') }}"
    class="btn btn-secondary"
>
    <i class="fas fa-times"></i>
    {{ __('cancel') }}
</a>