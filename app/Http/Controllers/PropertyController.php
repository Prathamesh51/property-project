<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePropertyRequest;
use App\Models\Property;
use App\Repositories\Contracts\PropertyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    protected $propertyRepository;
    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $data = $this->propertyRepository->getAllPropertyies($request->toArray());
        return view('property.index', $data);
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
    public function store(CreatePropertyRequest $request)
    {
        $property = $this->propertyRepository->createProperty($request->toArray());

        if($property) {
            return redirect('/property')->with('success', 'Property created successfully.');
        } 
        return response()->json(['error' => 'Failed to create property'], 500);
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
        $data = $this->propertyRepository->editProperty($propetryId);
        return view('property.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePropertyRequest $request, string $id)
    {
        $this->propertyRepository->updateProperty($id, $request->toArray());
        return redirect('/property')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->propertyRepository->deleteProperty($id);
        if ($deleted) {
            return redirect('/property')->with('success', 'Property deleted successfully.');
        }
        return redirect('/property')->with('error', 'Failed to delete property.');
    }

    public function filterProperties(Request $request)
    {
        $data = $this->propertyRepository->getAllPropertyies($request->toArray());
        return view('property.propertyTable', $data)->render();
    }
}
