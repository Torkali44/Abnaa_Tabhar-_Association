<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllEmployees()
    {
        return $this->repository->getAll();
    }

    public function getEmployee($id)
    {
        return $this->repository->findById($id);
    }

    public function createEmployee(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateEmployee($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteEmployee($id)
    {
        return $this->repository->delete($id);
    }
}
