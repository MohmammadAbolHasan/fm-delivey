<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'currency' => 'required|string|max:10',
            'invoice_prefix' => 'required|string|max:20',
        ]);

        session([
            'company_name' => $request->company_name,
            'company_phone' => $request->phone,
            'company_email' => $request->email,
            'company_address' => $request->address,
            'currency' => $request->currency,
            'invoice_prefix' => $request->invoice_prefix,
        ]);

        return redirect()
            ->route('settings')
            ->with('success', __('settings_saved'));
    }
}