<?php

namespace App\Domain\Book;

use App\Models\Book;

interface BookRepository
{
    public function show(): array;

    public function findById(int $id): ?Book;
    
    public function create(array $data): Book;

    public function update(int $id, array $data): Book;

    public function delete(int $id): bool;
}