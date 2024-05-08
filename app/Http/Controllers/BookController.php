<?php

namespace App\Http\Controllers;

use App\Domain\Book\BookService;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index()
    {
        $books = $this->bookService->showBooks();
        return response()->json($books, 201);

    }
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->bookService->createBook($data);

        if ($result['status_code'] == 201) {
            return response()->json(['message' => 'Book created successfully'], 201);
        } else {
            return response()->json(['error' => 'Error creating book'], 400);
        }
    }
    public function update(Request $request, int $id)
    {
        $data = $request->all();

        $result = $this->bookService->updateBook($id, $data);

        if ($result['status_code'] === 200) {
            return response()->json(['message' => 'Book successfully updated'], 200);
        } else {
            return response()->json(['error' => 'Error updating book'], 400);
        }
    }
    public function destroy(int $id){ 
        $result = $this->bookService->deleteBook($id);

        if ($result['status_code'] === 204) {
            return response()->json(['message' => 'Book successfully deleted'], 204);
        } else {
            return response()->json(['error' => 'Error deleting book'], 400);
        }
    }
    public function stores(int $id){ 
        $stores = $this->bookService->searchStores($id);

        if ($stores['status_code'] === 200) {
            return response()->json($stores['stores'], 200);
        } else {
            return response()->json(['message' => 'No stores found for this book'], 200);
        }
    }
}
