<?php

namespace App\Services\Dashboard;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function list(): Collection
    {
        $reports = Role::all();
        return $reports;
    }

    public function store(array $data): Role
    {
        $report = Role::create($data);
        return $report;
    }

    public function update(array $data): Role
    {
        $report = $this->findById($data['id']);

        $report->update($data);

        return $report->fresh();
    }

    public function findById(int $id): Role
    {
        $report = Role::findOrFail($id);
        return $report;
    }

    public function destroy(string $id)
    {
        $report = $this->findById($id);
        $report->delete();
    }
}
