<?php

namespace App\Repositories;

use App\Models\SupporterIndividual;

class SupporterIndividualRepository
{
    public function getAll()
    {
        return SupporterIndividual::latest()->get();
    }

    public function findById($id)
    {
        return SupporterIndividual::findOrFail($id);
    }

    public function create(array $data)
    {
        return SupporterIndividual::create($data);
    }

    public function update($id, array $data)
    {
        $ind = $this->findById($id);
        $ind->update($data);
        return $ind;
    }

    public function delete($id)
    {
        $ind = $this->findById($id);
        return $ind->delete();
    }
}

