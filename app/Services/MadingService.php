<?php

namespace App\Services;

use App\Repositories\MadingRepositoryInterface;
use Illuminate\Http\Request;

class MadingService
{
    protected $madingRepository;

    public function __construct(MadingRepositoryInterface $madingRepository)
    {
        $this->madingRepository = $madingRepository;
    }

    public function getPagination($page)
    {
        return $this->madingRepository->paginate($page);
    }

    public function getAllMadings()
    {
        return $this->madingRepository->all();
    }

    public function createMading(array $data)
    {
        $validatedData = $this->validateMadingData($data);
        return $this->madingRepository->create($validatedData);
    }

    public function getMadingById($id)
    {
        return $this->madingRepository->find($id);
    }

    public function updateMading(array $data, $id)
    {
        $validatedData = $this->validateMadingData($data);
        return $this->madingRepository->update($validatedData, $id);
    }

    public function deleteMading($id)
    {
        return $this->madingRepository->delete($id);
    }

    private function validateMadingData(array $data)
    {
        return validator($data, [
            'project_owner' => 'nullable|string|max:255',
            'work_location' => 'nullable|string|max:255',
            'type_of_work' => 'nullable|string',
            'status' => 'nullable|in:Tagihan DP,FPP,Pengadaan,Running,Finish,RETUR & BAST,Invoice,Lunas',
            'tanggal' => 'nullable|date',
            'pic' => 'nullable|string|max:255',
            'status_color' => 'nullable|string',
        ])->validate();
    }
}
