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
        $book = Book::create($data);
        ImageService::saveImage($data['image'], '/images/books/');
        return $book;
    }

    public function update(array $data): Book
    {
        $book = $this->findById($data['id']);

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
        $book->delete();
    }
}
