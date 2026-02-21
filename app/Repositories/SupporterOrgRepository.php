<?php

namespace App\Repositories;

use App\Models\SupporterOrg;

class SupporterOrgRepository
{
    public function getAll()
    {
        return SupporterOrg::latest()->get();
    }

    public function findById($id)
    {
        return SupporterOrg::findOrFail($id);
    }

    public function create(array $data)
    {
        return SupporterOrg::create($data);
    }

    public function update($id, array $data)
    {
        $org = $this->findById($id);
        $org->update($data);
        return $org;
    }

    public function delete($id)
    {
        $org = $this->findById($id);
        return $org->delete();
    }
}
