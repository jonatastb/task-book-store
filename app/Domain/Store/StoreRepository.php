<?php

namespace App\Domain\Store;

use App\Models\Store;

interface StoreRepository
{
    public function show(): array;
    
    public function findById(int $id): ?Store;

    public function create(array $data): Store;

    public function update(int $id, array $data): Store;

    public function delete(int $id): bool;

}
