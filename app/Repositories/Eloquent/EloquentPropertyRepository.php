<?php

namespace App\Repositories\Eloquent;

use App\Models\Property;
use App\Repositories\Contracts\PropertyRepository;
use Illuminate\Support\Facades\Auth;

class EloquentPropertyRepository implements PropertyRepository
{
    protected $user;
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getAllPropertyies(array $requestData)
    {   
        $search = $requestData['search'] ?? null;
        $min_price = $requestData['min_price'] ?? null;
        $max_price = $requestData['max_price'] ?? null;
        $userName = $this->user ? $this->user->name : '';
        $query = Property::query();

        $query->when($search, function ($q) use ($search) {
            $q->where('title', 'ilike', "%".$search."%")
                ->orWhere('description', 'ilike', "%".$search."%")
                ->orWhere('location', 'ilike', "%".$search."%")
                ->orWhere('type', 'ilike', "%".$search."%")
                ->orWhere('price', 'ilike', "%".$search."%");
        });
        $query->when($min_price, function ($q) use ($min_price) {
            $q->where('price', '>=', $min_price);
        });
        $query->when($max_price, function ($q) use ($max_price) {
            $q->where('price', '<=', $max_price);
        });
        $properties = $query->paginate(5);
        
        return compact('properties', 'userName');
    }

    public function getPropertyById($id)
    {
        // Implementation to retrieve a property by its ID
    }

    public function createProperty(array $data)
    {
        $property = new Property();
        $property->fill($data);
        $property->save();
        return $property;
    }

    public function editProperty($id)
    {
        $property = Property::findOrFail($id);
        $userName = $this->user ? $this->user->name : '';
        return compact('property', 'userName'); 
    }

    public function updateProperty($id, array $data)
    {
        $property = Property::findOrFail($id);
        $property->fill($data);
        $property->update();

        return $property;
    }

    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);
        return $property->delete();
    }
}
