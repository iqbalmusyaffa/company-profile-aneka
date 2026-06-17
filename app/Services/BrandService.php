<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandService
{
    protected $repository;

    public function __construct(BrandRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginate($perPage = 15)
    {
        return $this->repository->paginate($perPage);
    }


    public function getAll()
    {
        return $this->repository->all();
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
