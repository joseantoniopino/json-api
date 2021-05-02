<?php


namespace Src\Contracts;

interface ApiRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete(string $id);
    public function find(string $id);
}
