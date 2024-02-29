<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::all();
        $clients = $clients->sortByDesc('name');
        return response()->json($clients);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
        ]);

        // Create new client
        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        // Set other fields

        $client->save();

        return response()->json($client, 201);
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $client = Client::findOrFail($uuid);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */ public function edit($uuid)
    {
        $client = Client::findOrFail($uuid);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$uuid,
        ]);

        $client = Client::find($uuid);
        $client->update($request->all());

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully']);
    }
}
