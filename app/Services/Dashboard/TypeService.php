<?php

namespace App\Services\Dashboard;

use App\Models\Type;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TypeService
{
    public function list(): Collection
    {
        $types = Type::all();
        return $types;
    }

    public function store(array $data): Type
    {
        $type = Type::create($data);
        return $type;
    }

    public function update(array $data): Type
    {
        $type = $this->findById($data['id']);

        $type->update($data);

        return $type->fresh();
    }

    public function findById(int $id): Type
    {
        $type = Type::findOrFail($id);
        return $type;
    }

    public function destroy(string $id)
    {
        $type = $this->findById($id);
        if ($type->contents->count() > 0) {
            throw new Exception('Type cannot be deleted. Associated contents exist', 409);
        }
        $type->delete();
    }
}
