<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
public function index(Request $request)
{
    $query = Invoice::with(['client', 'driver']);

    // Normal search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('invoice_number', 'like', "%{$search}%")
                ->orWhere('receiver_name', 'like', "%{$search}%")
                ->orWhere('receiver_phone', 'like', "%{$search}%")
                ->orWhereHas('client', function ($clientQuery) use ($search) {
                    $clientQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('driver', function ($driverQuery) use ($search) {
                    $driverQuery->where('name', 'like', "%{$search}%");
                });

        });
    }

    // Search by date
    if ($request->filled('date')) {
        $query->whereDate('invoice_date', $request->date);
    }

    // Totals for all filtered invoices
    $totalGoodsAmount = (clone $query)->sum('amount');
    $totalDriverAmount = (clone $query)->sum('driver_amount');

    $invoices = $query
        ->orderByDesc('invoice_date')
        ->paginate(15)
        ->withQueryString();

    return view('invoices.index', compact(
        'invoices',
        'totalGoodsAmount',
        'totalDriverAmount'
    ));
}
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $drivers = Driver::orderBy('name')->get();

        return view('invoices.create', compact('clients', 'drivers'));
    }
    public function show(Invoice $invoice)
{
    $invoice->load(['client', 'driver']);

    return view('invoices.show', compact('invoice'));
}

    public function store(StoreInvoiceRequest $request)
    {
        Invoice::create($request->validated());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::orderBy('name')->get();
        $drivers = Driver::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'clients', 'drivers'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function pending()
{
    $invoices = Invoice::where('status', 'Pending')
        ->latest()
        ->paginate(10);

    return view('invoices.index', compact('invoices'));
}

public function done()
{
    $invoices = Invoice::where('status', 'Done')
        ->latest()
        ->paginate(10);

    return view('invoices.index', compact('invoices'));
}

public function rejected()
{
    $invoices = Invoice::where('status', 'Rejected')
        ->latest()
        ->paginate(10);

    return view('invoices.index', compact('invoices'));
}

public function delayed()
{
    $invoices = Invoice::where('status', 'Delayed')
        ->latest()
        ->paginate(10);

    return view('invoices.index', compact('invoices'));
}
public function changeStatus(Invoice $invoice, $status)
{
    $allowed = ['Pending', 'Done', 'Rejected', 'Delayed'];

    if (! in_array($status, $allowed)) {
        abort(404);
    }

    $invoice->update([
        'status' => $status,
    ]);

    return back()->with('success', 'Invoice status updated successfully.');
}
public function downloadPdf(Invoice $invoice)
{
    $invoice->load(['client', 'driver']);

    $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

    return $pdf->download(
        'invoice-' . $invoice->invoice_number . '.pdf'
    );
}
}