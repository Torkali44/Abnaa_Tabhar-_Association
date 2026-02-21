<?php

namespace App\Services;

use App\Repositories\SupporterOrgRepository;
use App\Repositories\SupporterIndividualRepository;

class SupporterService
{
    protected $orgRepository;
    protected $indRepository;

    public function __construct(SupporterOrgRepository $orgRepo, SupporterIndividualRepository $indRepo)
    {
        $this->orgRepository = $orgRepo;
        $this->indRepository = $indRepo;
    }

    public function getAllOrgs()
    {
        return $this->orgRepository->getAll();
    }

    public function getOrg($id)
    {
        return $this->orgRepository->findById($id);
    }

    public function createOrg(array $data)
    {
        return $this->orgRepository->create($data);
    }

    public function updateOrg($id, array $data)
    {
        return $this->orgRepository->update($id, $data);
    }

    public function deleteOrg($id)
    {
        return $this->orgRepository->delete($id);
    }

    public function getAllIndividuals()
    {
        return $this->indRepository->getAll();
    }

    public function getIndividual($id)
    {
        return $this->indRepository->findById($id);
    }

    public function createIndividual(array $data)
    {
        return $this->indRepository->create($data);
    }

    public function updateIndividual($id, array $data)
    {
        return $this->indRepository->update($id, $data);
    }

    public function deleteIndividual($id)
    {
        return $this->indRepository->delete($id);
    }
}

