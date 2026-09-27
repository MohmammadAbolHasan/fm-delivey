<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_number'   => 'required|string|max:255|unique:invoices,invoice_number',

            'client_id'        => 'required|exists:clients,id',

            'driver_id'        => 'required|exists:drivers,id',

            'receiver_name'    => 'required|string|max:255',

            'receiver_phone'   => 'nullable|string|max:20',

            'receiver_address' => 'required|string',

            'amount'           => 'required|numeric|min:0',

            'invoice_date'     => 'required|date',

            'status'           => 'required|in:Pending,Done,Rejected,Delayed',

            'notes'            => 'nullable|string',
        ];
    }
}