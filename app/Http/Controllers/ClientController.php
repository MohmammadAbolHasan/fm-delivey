<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client created successfully.');
    }


    public function edit(Client $client)
{
    return view('clients.edit', compact('client'));
}

public function update(UpdateClientRequest $request, Client $client)
{
    $client->update($request->validated());

    return redirect()
        ->route('clients.index')
        ->with('success', 'Client updated successfully.');
}

public function destroy(Client $client)
{
    $client->delete();

    return redirect()
        ->route('clients.index')
        ->with('success', 'Client deleted successfully.');
} 
}