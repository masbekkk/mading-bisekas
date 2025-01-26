<?php

namespace App\Repositories;

use App\Models\Mading;
use App\Repositories\MadingRepositoryInterface;

class MadingRepository implements MadingRepositoryInterface
{
    public function paginate($page)
    {
        return Mading::paginate($page);
    }

    public function order($column, $order)
    {
        return Mading::orderBy($column, $order)->with('user')->get();
    }

    public function all()
    {
        return Mading::all();
    }

    public function where($condition)
    {
        return Mading::where($condition)->get();
    }

    public function create(array $data)
    {
        return Mading::create($data);
    }

    public function find($id)
    {
        return Mading::where('id', $id)->with('comments.user')->first();
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
