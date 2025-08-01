<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $locationName = strtolower($request->query('location'));
        $location = Location::where('name', $locationName)->first();

        return response()->json([
            'percentage' => $location->price_increase_percentage ?? 0
        ]);
    }
    public function setLocation(Request $request)
    {
        $locationName = strtolower($request->input('location'));
        $location = Location::where('name', $locationName)->first();

        if (!$location) {
            return response()->json(['error' => 'Invalid location'], 400);
        }

        session([
            'user_location' => $location->name,
            'price_increase' => $location->price_increase_percentage
        ]);

        return response()->json(['message' => 'Location set']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
