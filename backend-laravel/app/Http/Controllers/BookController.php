<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    class BookController extends Controller
{
    public function index() {
        return Book::all();
    }

    public function store(Request $request) {
        return Book::create($request->all());
    }

    public function update(Request $request, Book $book) {
        $book->update($request->all());
        return $book;
    }

    public function destroy(Book $book) {
        $book->delete();
        return response()->json(['message' => 'Deleted']);
    }
}

}
