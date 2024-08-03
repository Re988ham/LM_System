<?php

namespace App\Services\Dashboard;

use App\Models\Advertisement;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AdsService
{
    public function list(): Collection
    {
        $advertisements = Advertisement::all();
        return $advertisements;
    }

    public function store(array $data): Advertisement
    {
        $advertisement = Advertisement::create($data);
        return $advertisement;
    }

    public function update(array $data): Advertisement
    {
        $advertisement = $this->findById($data['id']);

        $advertisement->update($data);

        return $advertisement->fresh();
    }

    public function findById(int $id): Advertisement
    {
        $advertisement = Advertisement::findOrFail($id);
        return $advertisement;
    }

    public function destroy(string $id)
    {
        $advertisement = $this->findById($id);
        if ($advertisement->specialization != null) {
            throw new Exception('Advertisement cannot be deleted. Associated specialization exist', 409);
        }
        $advertisement->delete();
    }
}
