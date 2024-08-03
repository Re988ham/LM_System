<?php

namespace App\Services\Dashboard;

use App\Models\Specialization;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SpecializationService
{
    public function list(): Collection
    {
        $specializations = Specialization::orderBy('name')->get();
        return $specializations;
    }

    public function store(array $data): Specialization
    {
        $specialization = Specialization::create($data);
        return $specialization;
    }

    public function update(array $data): Specialization
    {
        $specialization = $this->findById($data['id']);

        $specialization->update($data);

        return $specialization->fresh();
    }

    public function findById(int $id): Specialization
    {
        $specialization = Specialization::findOrFail($id);
        return $specialization;
    }

    public function destroy(string $id)
    {
        $specialization = $this->findById($id);
        if ($specialization->users->count() > 0 || $specialization->courses->count() > 0) {
            throw new Exception('Specialization cannot be deleted. Associated users or courses exist', 409);
        }
        $specialization->delete();
    }

    ############################# Additional #############################
    public function getAllSpecializationsChoices() {
        return Specialization::pluck('name', 'id');
    }
}
