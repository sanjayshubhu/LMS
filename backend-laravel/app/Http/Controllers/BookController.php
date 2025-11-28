<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return Book::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'=>'required|string',
            'author'=>'required|string',
            'quantity'=>'required|integer|min:0'
        ]);

        $book = Book::create($validated);
        return response()->json($book,201);
    }

    public function show(Book $book) { return $book; }

    public function update(Request $request, Book $book) {
        $book->update($request->all());
        return response()->json($book);
    }

    public function destroy(Book $book) {
        $book->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
