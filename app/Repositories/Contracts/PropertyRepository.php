<?php

namespace App\Repositories\Contracts;

interface PropertyRepository
{
    public function getAllPropertyies(array $requestData);
    public function getPropertyById($id);
    public function createProperty(array $data);
    public function editProperty($id);
    public function updateProperty($id, array $data);
    public function deleteProperty($id);
}
