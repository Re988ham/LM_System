<?php

namespace App\Services\Dashboard;

use App\Models\Advertisement;
use App\Services\GeneralServices\ImageService;
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
        $data['image'] = ImageService::saveImage($data['image'], '/images/advertisements/');
        $advertisement = Advertisement::create($data);
        return $advertisement;
    }

    public function update(array $data): Advertisement
    {
        $advertisement = $this->findById($data['id']);

        $isDeleted = ImageService::deleteImage($advertisement->image);
        if (isset($data['image'])) {
            $destinationPath = 'images/advertisements/';
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }

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
        $isDeleted = ImageService::deleteImage($advertisement->image);
        $advertisement->delete();
    }
}
