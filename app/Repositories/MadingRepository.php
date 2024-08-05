<?php

namespace App\Repositories;

use App\Models\Mading;
use App\Repositories\MadingRepositoryInterface;

class MadingRepository implements MadingRepositoryInterface
{
    public function all()
    {
        return Mading::all();
    }

    public function create(array $data)
    {
        return Mading::create($data);
    }

    public function find($id)
    {
        return Mading::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $mading = Mading::findOrFail($id);
        $mading->update($data);
        return $mading;
    }

    public function delete($id)
    {
        Mading::destroy($id);
        return true;
    }
}
