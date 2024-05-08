<?php

namespace App\Domain\Store;

use App\Models\Book;
use App\Models\Store;

class StoreService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function showStores(): array
    {
        try {
            
            $allStores = $this->storeRepository->show();
            return $allStores;

        } catch (\Exception $e) {
            return [];
        }
    }
    public function createStore(array $data): array
    {
        try {

            $name = $data['name'];
            $address = $data['address'];
            $active = $data['active'];
    
            $store = $this->storeRepository->create([
                'name' => $name,
                'address' => $address,
                'active' => $active,
            ]);

            if (!empty($data['books'])) {
                $bookIds = array_unique($data['books']);
                $validBookIds = [];
    
                foreach ($bookIds as $bookId) {
                    if (Book::where('id', $bookId)->exists() && !$store->books()->where('book_id', $bookId)->exists()) {
                        $validBookIds[] = $bookId;
                    }
                }
    
                $store->books()->attach($validBookIds);
            }
    
            return ['store' => $store, 'status_code' => 201];

        } catch (\Exception $e) {
            dd($e->getMessage());
            return ['error' => 'Error creating store', 'status_code' => 400];
        }
    }

    public function updateStore(int $id, array $data): array
    {
        try {
            $store = $this->storeRepository->update($id, $data);

            if (!empty($data['books'])) {
                $bookIds = array_unique($data['books']);
                $validBookIds = [];
    
                foreach ($bookIds as $bookId) {
                    if (Book::where('id', $bookId)->exists() && !$store->books()->where('book_id', $bookId)->exists()) {
                        $validBookIds[] = $bookId;
                    }
                }
    
                $store->books()->attach($validBookIds);
            }

            return ['store' => $store, 'status_code' => 200];
        } catch (\Exception $e) {
            return ['error' => 'Error updating store', 'status_code' => 400];
        }
    }

    public function deleteStore(int $id): array
    {
        try {
            $result = $this->storeRepository->delete($id);
            return ['success' => $result, 'status_code' => 204];
        } catch (\Exception $e) {
            return ['error' => 'Error deleting store', 'status_code' => 400];
        }
    }

    public function searchBooks(int $id): array 
    {
        try {
            $store = $this->storeRepository->findById($id);

            if (!$store) {
                return ['error' => 'Store not found', 'status_code' => 404];
            }

            $books = $store->books()->get();

            if ($books->isEmpty()) {
                return ['message' => 'No books found for this store', 'status_code' => 204];
            }

            return ['books' => $books, 'status_code' => 200];

        } catch (\Throwable $th) {
            return ['error' => 'Error searching books for store', 'status_code' => 400];
        }
    }
    public function deleteBookFromStore(int $idStore, int $idBook) : array {
        try {
            $store = Store::findOrFail($idStore);
            $store->books()->detach($idBook);
    
            return ['success' => true, 'status_code' => 204];
        } catch (\Exception $e) {
            return ['error' => 'Error deleting book from store', 'status_code' => 400];
        }
    }
}
