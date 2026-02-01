<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();

        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('property.index', compact('properties', 'userName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('property.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,sold',
            'image' => 'nullable|image|max:2048',
        ]);

        $property = new Property();
        $property->fill($requestData);
        $property->save();

        return redirect('/property')->with('success', 'Property created successfully.');
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
    public function edit(string $propetryId)
    {
       $property = Property::findOrFail($propetryId);
        return view('property.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,sold',
            'image' => 'nullable|image|max:2048',
        ]);

        $property = Property::findOrFail($id);
        $property->fill($requestData);
        $property->save();

        return redirect('/property')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect('/property')->with('success', 'Property deleted successfully.');
    }
}
