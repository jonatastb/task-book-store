<?php

namespace App\Http\Controllers;

use App\Domain\Store\StoreService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        $stores = $this->storeService->showStores();
        return response()->json($stores, 201);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->storeService->createStore($data);

        if ($result['status_code'] == 201) {
            return response()->json(['message' => 'Store created successfully'], 201);
        } else {
            return response()->json(['error' => 'Error creating store'], 400);
        }
    }
    public function update(Request $request, int $id)
    {
        $data = $request->all();

        $result = $this->storeService->updateStore($id, $data);

        if ($result['status_code'] === 200) {
            return response()->json(['message' => 'Store successfully updated'], 200);
        } else {
            return response()->json(['error' => 'Error updating store'], 400);
        }
    }
    public function destroy(int $id) 
    {
        $result = $this->storeService->deleteStore($id);

        if ($result['status_code'] === 204) {
            return response()->json(['message' => 'Store successfully deleted'], 204);
        } else {
            return response()->json(['error' => 'Error deleting store'], 400);
        }
        
    }
    public function books(int $id) {

        $books = $this->storeService->searchBooks($id);

        if ($books['status_code'] === 200) {
            return response()->json($books['books'], 200);
        } else {
            return response()->json(['message' => 'No books found for this store'], 200);
        }
    }
    public function deleteBook(int $idStore, int $idBook) {
        $result = $this->storeService->deleteBookFromStore($idStore, $idBook);

        if ($result['status_code'] === 204) {
            return response()->json(['message' => 'Book successfully deleted from store'], 204);
        } else {
            return response()->json(['error' => 'Error deleting book from store'], 400);
        }
    }
}