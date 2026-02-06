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
    public function index(Request $request)
    {        
        $properties = $this->getPropertiesData($request);
        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('property.index', compact('properties', 'userName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('property.create', compact('userName'));
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
       $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('property.edit', compact('property', 'userName'));
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

    public function filterProperties(Request $request)
    {
        $properties = $this->getPropertiesData($request);
        return view('property.propertyTable', compact('properties'))->render();
    }

    private function getPropertiesData(Request $request)
    {
        $search = $request->input('search');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $query = Property::query();
// dd($query->get());
        $query->when($search, function ($q) use ($search) {
            $q->where('title', 'ilike', "%".$search."%")
                ->orWhere('description', 'ilike', "%".$search."%")
                ->orWhere('location', 'ilike', "%".$search."%")
                ->orWhere('type', 'ilike', "%".$search."%")
                ->orWhere('price', 'ilike', "%".$search."%");
        });
// dd($query->tosql());
    // dd($query->get()->toArray());
        $query->when($min_price, function ($q) use ($min_price) {
            $q->where('price', '>=', $min_price);
        });
        $query->when($max_price, function ($q) use ($max_price) {
            $q->where('price', '<=', $max_price);
        });
        $properties = $query->paginate(5);
        // dd($min_price,$properties->toArray());
        return $properties;
    }
}
