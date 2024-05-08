<?php

namespace App\Domain\Book;

use App\Models\Store;
use App\Domain\Book\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function showBooks(): array 
    {
        try {
            
            $allBooks = $this->bookRepository->show();
            return $allBooks;

        } catch (\Exception $e) {
            return [];
        }
    }
    public function createBook(array $data): array
    {
        try {

            $name  = $data['name'];
            $isbn  = $data['isbn'];
            $value = $data['value'];

            $book = $this->bookRepository->create([
                'name'  => $name,
                'isbn'  => $isbn,
                'value' => $value
            ]);
            
            if ($data['stores']) {
                
                $storesIds = array_unique($data['stores']);
                $validStoresIds = [];
    
                foreach ($storesIds as $storeId) {
                    if (Store::where('id', $storeId)->exists() && !$book->stores()->where('store_id', $storeId)->exists()) {
                        $validStoresIds[] = $storeId;
                    }
                }
    
                $book->stores()->attach($validStoresIds);

            }

            return ['book' => $book, 'status_code' => 201]; 
        } catch (\Exception $e) {
            return ['error' => 'Error creating book', 'status_code' => 400]; 
        }
    }

    public function updateBook(int $id, array $data): array
    {
        try {
            $book = $this->bookRepository->update($id, $data);

            if ($data['stores']) {
                
                $storesIds = array_unique($data['stores']);
                $validStoresIds = [];
    
                foreach ($storesIds as $storeId) {
                    if (Store::where('id', $storeId)->exists() && !$book->stores()->where('store_id', $storeId)->exists()) {
                        $validStoresIds[] = $storeId;
                    }
                }
    
                $book->stores()->attach($validStoresIds);

            }

            return ['book' => $book, 'status_code' => 200];
        } catch (\Exception $e) {
            return ['error' => 'Error updating book', 'status_code' => 400];
        }
    }

    public function deleteBook(int $id): array
    {
        try {
            $result = $this->bookRepository->delete($id);
            return ['success' => $result, 'status_code' => 204]; 
        } catch (\Exception $e) {
            return ['error' => 'Error deleting book', 'status_code' => 400]; 
        }
    }
    public function searchStores(int $id) : array {
        try {
            $stores = $this->bookRepository->findById($id);

            if (!$stores) {
                return ['error' => 'Book not found', 'status_code' => 404];
            }

            $stores = $stores->stores()->get();

            if ($stores->isEmpty()) {
                return ['message' => 'No stores found for this book', 'status_code' => 204];
            }

            return ['stores' => $stores, 'status_code' => 200];

        } catch (\Throwable $th) {
            return ['error' => 'Error searching stores for book', 'status_code' => 400];
        }
    }
}