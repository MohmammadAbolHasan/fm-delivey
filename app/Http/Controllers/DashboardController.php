<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Main statistics
        $clients = Client::count();
        $drivers = Driver::count();
        $invoices = Invoice::count();

        // Invoice statuses
        $pending = Invoice::where('status', 'Pending')->count();
        $done = Invoice::where('status', 'Done')->count();
        $rejected = Invoice::where('status', 'Rejected')->count();
        $delayed = Invoice::where('status', 'Delayed')->count();

        // Total amounts for DONE invoices
        $totalItemsAmount = Invoice::where('status', 'Done')
            ->sum('amount');

        $totalDeliveryAmount = Invoice::where('status', 'Done')
            ->sum('driver_amount');

        // Driver performance
        $driverStats = Driver::withCount([
            'invoices as done_orders' => function ($q) {
                $q->where('status', 'Done');
            }
        ])
        ->withSum([
            'invoices as items_amount' => function ($q) {
                $q->where('status', 'Done');
            }
        ], 'amount')
        ->withSum([
            'invoices as delivery_amount' => function ($q) {
                $q->where('status', 'Done');
            }
        ], 'driver_amount')
        ->orderBy('name')
        ->get();

        return view('dashboard', compact(
            'clients',
            'drivers',
            'invoices',
            'pending',
            'done',
            'rejected',
            'delayed',
            'totalItemsAmount',
            'totalDeliveryAmount',
            'driverStats'
        ));
    }


    public function reports(Request $request)
    {
        $query = Invoice::with(['client', 'driver']);

        // From Date
        if ($request->filled('from')) {
            $query->whereDate('invoice_date', '>=', $request->from);
        }

        // To Date
        if ($request->filled('to')) {
            $query->whereDate('invoice_date', '<=', $request->to);
        }

        // Client
        if ($request->filled('client')) {
            $query->where('client_id', $request->client);
        }

        // Driver
        if ($request->filled('driver')) {
            $query->where('driver_id', $request->driver);
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Totals according to filters
        $totalGoodsAmount = (clone $query)->sum('amount');

        $totalDeliveryAmount = (clone $query)->sum('driver_amount');

        $grandTotal = $totalGoodsAmount + $totalDeliveryAmount;

        // Get invoices
        $invoices = $query
            ->orderByDesc('invoice_date')
            ->get();

        $clients = Client::orderBy('name')->get();
        $drivers = Driver::orderBy('name')->get();

        return view('reports.index', compact(
            'invoices',
            'clients',
            'drivers',
            'totalGoodsAmount',
            'totalDeliveryAmount',
            'grandTotal'
        ));
    }
}