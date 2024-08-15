<?php

namespace App\Services\Dashboard;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class ReportService
{
    public function list(): Collection
    {
        $reports = Report::all();
        return $reports;
    }

    public function store(array $data): Report
    {
        $report = Report::create($data);
        return $report;
    }

    public function update(array $data): Report
    {
        $report = $this->findById($data['id']);

        $report->update($data);

        return $report->fresh();
    }

    public function findById(int $id): Report
    {
        $report = Report::findOrFail($id);
        return $report;
    }

    public function destroy(string $id)
    {
        $report = $this->findById($id);
        $report->delete();
    }
}
