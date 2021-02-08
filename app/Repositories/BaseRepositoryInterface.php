<?php


namespace App\Repositories;


interface BaseRepositoryInterface
{
    public function all();
    public function get($id);
    public function create($data);
    public function delete($id);
    public function update($id, $data);
}
