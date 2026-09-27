<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->paginate(15);

        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(StoreDriverRequest $request)
    {
        Driver::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'car' => $request->car,
            'plate_number' => $request->plate_number,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Driver created successfully.');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'car' => $request->car,
            'plate_number' => $request->plate_number,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Driver deleted successfully.');
    }
}