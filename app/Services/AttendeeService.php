<?php

namespace App\Services;

use App\Repositories\Contracts\AttendeeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class AttendeeService
{
    protected $repository;

    public function __construct(AttendeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getPaginated(array $filters): LengthAwarePaginator {
        return $this->repository->paginateAndFilter($filters);
    }

    public function getById($id)
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
