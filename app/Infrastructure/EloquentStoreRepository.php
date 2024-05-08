<?php

namespace App\Infrastructure;

use App\Models\Store;
use App\Domain\Store\StoreRepository;

class EloquentStoreRepository implements StoreRepository
{
    public function show(): array
    {
        return Store::all()->toArray();
    }
    public function findById(int $id): ?Store
    {
        return Store::find($id);
    }

    public function create(array $data): Store
    {
        return Store::create($data);
    }

    public function update(int $id, array $data): Store
    {
        $store = Store::findOrFail($id);
        $store->update($data);
        return $store;
    }

    public function delete(int $id): bool
    {
        return Store::destroy($id) > 0;
    }
}
