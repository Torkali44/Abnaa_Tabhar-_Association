<?php

namespace App\Services;

use App\Repositories\BeneficiaryRepository;

class BeneficiaryService
{
    protected $repository;

    public function __construct(BeneficiaryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBeneficiaries()
    {
        return $this->repository->getAll();
    }

    public function getBeneficiary($id)
    {
        return $this->repository->findById($id);
    }

    private function calculateNeedLevel(array $data): string
    {
        $points = 0;
        
        $income = $data['monthly_income'] ?? 0;
        if ($income <= 2000) {
            $points += 5;
        } elseif ($income <= 4000) {
            $points += 3;
        } else {
            $points += 1;
        }

        $status = $data['social_status'] ?? '';
        if (str_contains($status, 'أرملة') || str_contains($status, 'مطلقة')) {
            $points += 3;
        }
        
        $familyStatusIcons = $data['family_status'] ?? [];
        if (in_array('أيتام', $familyStatusIcons)) {
            $points += 4;
        }
        if (in_array('مرض مزمن', $familyStatusIcons)) {
            $points += 4;
        }
        if (in_array('عجز كلي', $familyStatusIcons)) {
            $points += 5;
        }

        $childrenCount = count($data['children'] ?? []);
        if ($childrenCount >= 5) {
            $points += 4;
        } elseif ($childrenCount >= 3) {
            $points += 2;
        }

        if ($points >= 10) {
            return 'عالي';
        }
        if ($points >= 5) {
            return 'متوسط';
        }
        return 'منخفض';
    }

    public function createBeneficiary(array $data)
    {
        $data['need_level'] = $this->calculateNeedLevel($data);
        return $this->repository->create($data);
    }

    public function updateBeneficiary($id, array $data)
    {
        $data['need_level'] = $this->calculateNeedLevel($data);
        return $this->repository->update($id, $data);
    }

    public function deleteBeneficiary($id)
    {
        return $this->repository->delete($id);
    }
}

