<?php

namespace App\Services;

use App\Repositories\MadingRepositoryInterface;
use App\Models\Mading;
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

    public function getMadingOrder($column, $order)
    {
        return $this->madingRepository->order($column, $order);
    }

    public function getAllMadings()
    {
        return $this->madingRepository->all();
    }

    public function getAllMadingsWithCondition($condition)
    {
        return $this->madingRepository->where($condition);
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
        $statuses =  Mading::getStatusList();
        
        return validator($data, [
            'user_id' => 'nullable|integer',
            'work_location' => 'nullable|string|max:255',
            'type_of_work' => 'nullable|string',
            'status' => 'nullable|in:'.implode(',', $statuses),
            'tanggal' => 'nullable|date',
            'pic' => 'nullable|string|max:255',
            'status_color' => 'nullable|string',
            'status_pending' => 'nullable|string',
            'need_approve' => 'nullable|boolean',
            'approved' => 'nullable|boolean',
            'rejected' => 'nullable|boolean',
            'document' => 'nullable|string',
            'image_ids' => 'nullable|string',
        ])->validate();
    }
}
