<?php

namespace App\Http\Controllers;

use App\Models\Borrowrecord;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index() {
        return Borrowrecord::with('book')->where('user_id', auth()->id())->get();
    }

    public function borrow(Book $book) {
        if($book->quantity <= 0) return response()->json(['error'=>'No copies available'],400);

        Borrowrecord::create([
            'user_id'=>auth()->id(),
            'book_id'=>$book->id
        ]);

        $book->decrement('quantity');
        return response()->json(['message'=>'Book borrowed']);
    }

    public function returnBook(Borrowrecord $borrow) {
        if($borrow->user_id !== auth()->id()) return response()->json(['error'=>'Not allowed'],403);

        $borrow->update(['returned'=>true]);
        $borrow->book->increment('quantity');
        return response()->json(['message'=>'Book returned']);
    }
}
