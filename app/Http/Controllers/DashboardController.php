<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::count();

        $drivers = Driver::count();
        $invoices = Invoice::count();

        $pending = Invoice::where('status', 'Pending')->count();

        $done = Invoice::where('status', 'done')->count();

        $rejected = Invoice::where('status', 'Rejected')->count();

        $delayed = Invoice::where('status', 'Delayed')->count();

        $totalMoney = Invoice::where('status', 'done')->sum('amount');

        $driverStats = Driver::withCount([
    'invoices as done_orders' => function ($q) {
        $q->where('status', 'done');
    }
])
->withSum([
    'invoices as total_money' => function ($q) {
        $q->where('status', 'done');
    }
], 'amount')
->get();

        return view('dashboard', compact(
            'clients',
            'drivers',
            'driverStats',
            'pending',
            'done',
            'rejected',
            'delayed',
            'totalMoney',
            'invoices'
        ));
    }
    public function reports(Request $request)
{
    $query = Invoice::with(['client','driver']);

    if ($request->filled('from')) {
        $query->whereDate('invoice_date','>=',$request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('invoice_date','<=',$request->to);
    }

    if ($request->filled('client')) {
        $query->where('client_id',$request->client);
    }

    if ($request->filled('driver')) {
        $query->where('driver_id',$request->driver);
    }

    if ($request->filled('status')) {
        $query->where('status',$request->status);
    }

    $invoices = $query->latest()->get();

    $totalRevenue = $invoices
        ->where('status','done')
        ->sum('amount');

    $clients = Client::orderBy('name')->get();
    $drivers = Driver::orderBy('name')->get();

    return view('reports.index', compact(
        'invoices',
        'clients',
        'drivers',
        'totalRevenue'
    ));
}
}