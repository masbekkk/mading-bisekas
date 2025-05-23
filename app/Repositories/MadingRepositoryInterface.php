<?php

namespace App\Repositories;

interface MadingRepositoryInterface
{
    public function paginate($page);
    public function order($column, $order);
    public function all();
    public function where($condition);
    public function create(array $data);
    public function find($id);
    public function update(array $data, $id);
    public function delete($id);
}
