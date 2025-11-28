<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowController extends Controller
{
   class BorrowController extends Controller
{
    public function index() {
        return BorrowRecord::with('book', 'user')->get();
    }

    public function borrow(Request $request, Book $book) {
        if ($book->quantity <= 0)
            return response()->json(['message' => 'Not available'], 400);

        $record = BorrowRecord::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
        ]);

        $book->decrement('quantity');

        return $record;
    }

    public function returnBook($id) {
        $record = BorrowRecord::findOrFail($id);

        $record->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        $record->book->increment('quantity');

        return $record;
    }
}

}
