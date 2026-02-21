<?php

namespace App\Repositories;

use App\Models\Beneficiary;

class BeneficiaryRepository
{
    public function getAll()
    {
        return Beneficiary::latest()->get();
    }

    public function findById($id)
    {
        return Beneficiary::findOrFail($id);
    }

    public function create(array $data)
    {
        return Beneficiary::create($data);
    }

    public function update($id, array $data)
    {
        $beneficiary = $this->findById($id);
        $beneficiary->update($data);
        return $beneficiary;
    }

    public function delete($id)
    {
        $beneficiary = $this->findById($id);
        return $beneficiary->delete();
    }
}

