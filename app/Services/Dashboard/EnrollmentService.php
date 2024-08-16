<?php

namespace App\Services\Dashboard;

use App\Enums\EnrollmentStatus;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Collection;

class EnrollmentService
{
    public function list(): Collection
    {
        return Enrollment::all();
    }

    public function create(array $data): Enrollment
    {
        return Enrollment::create($data);
    }

    public function update(array $data): Enrollment
    {
        $enrollment = $this->findById($data['id']);
        $enrollment->update($data);
        return $enrollment->fresh();
    }

    public function findById($id): Enrollment
    {
        $enrollment = Enrollment::findOrFail($id);
        return $enrollment;
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
    }

    public function accept(Enrollment $enrollment): void
    {
        $enrollment->changeStatus(EnrollmentStatus::ACCEPTED);
    }
}
