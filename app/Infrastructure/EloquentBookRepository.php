<?php

namespace App\Infrastructure;

use App\Models\Book;
use App\Domain\Book\BookRepository;

class EloquentBookRepository implements BookRepository
{
    public function show(): array
    {
        return Book::all()->toArray();
    }
    public function findById(int $id): ?Book
    {
        return Book::find($id);
    }
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function update(int $id, array $data): Book
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function delete(int $id): bool
    {
        return Book::destroy($id) > 0;
    }
}
