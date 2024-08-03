<?php

namespace App\Services\Dashboard;

use App\Models\Country;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CountryService
{
    public function list(): Collection
    {
        $countries = Country::all();
        return $countries;
    }

    public function store(array $data): Country
    {
        $country = Country::create($data);
        return $country;
    }

    public function update(array $data): Country
    {
        $country = $this->findById($data['id']);

        $country->update($data);

        return $country->fresh();
    }

    public function findById(int $id): Country
    {
        $country = Country::findOrFail($id);
        return $country;
    }

    public function destroy(string $id)
    {
        $country = $this->findById($id);
        if ($country->users->count() > 0 || $country->courses->count() > 0) {
            throw new Exception('Country cannot be deleted. Associated users or courses exist', 409);
        }
        $country->delete();
    }
}
