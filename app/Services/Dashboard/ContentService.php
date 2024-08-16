<?php

namespace App\Services\Dashboard;

use App\Enums\ContentStatus;
use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;

class ContentService
{
    public function list(): Collection
    {
        return Content::all();
    }

    public function create(array $data): Content
    {
        return Content::create($data);
    }

    public function update(array $data): Content
    {
        $content = $this->findById($data['id']);
        $content->update($data);
        return $content->fresh();
    }

    public function findById($id): Content
    {
        $content = Content::findOrFail($id);
        return $content;
    }

    public function destroy(Content $content)
    {
        $content->delete();
    }

    public function accept($id): Content
    {
        $content = Content::findOrFail($id);
        $content->changeStatus(ContentStatus::ACCEPTED);
        return $content->fresh();
    }
}
