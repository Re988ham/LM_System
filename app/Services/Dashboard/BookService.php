<?php

namespace App\Services\Dashboard;

use App\Models\Book;
use App\Services\GeneralServices\ImageService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    public function list(): Collection
    {
        $books = Book::all();
        return $books;
    }

    public function store(array $data): Book
    {
        $data['image'] = ImageService::saveImage($data['image'], '/images/books/');
        $book = Book::create($data);
        return $book;
    }

    public function update(array $data): Book
    {
        $book = $this->findById($data['id']);

        $isDeleted = ImageService::deleteImage($book->image);
        if (isset($data['image'])) {
            $destinationPath = 'images/books/';
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }

        $book->update($data);

        return $book->fresh();
    }

    public function findById(int $id): Book
    {
        $book = Book::findOrFail($id);
        return $book;
    }

    public function destroy(string $id)
    {
        $book = $this->findById($id);
        if ($book->specialization != null) {
            throw new Exception('Book cannot be deleted. Associated specialization exist', 409);
        }
        $isDeleted = ImageService::deleteImage($book->image);
        $book->delete();
    }
}
