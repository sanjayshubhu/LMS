<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowrecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();
        return view('pages.books.index', compact('books'));
    }

    public function create() {
        return view('pages.books.create');
    }

    public function store(Request $request) {

        // Validate inputs including unique ISBN
        $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'category'  => 'required|string|max:255',
            'isbn'      => 'required|string|unique:books,isbn',
            'quantity'  => 'required|integer|min:1',
        ]);

        // Create the book
        Book::create([
            'title'    => $request->title,
            'author'   => $request->author,
            'category' => $request->category,
            'isbn'     => $request->isbn,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Book added successfully');
    }

    public function borrow(Book $book) {

        if ($book->quantity < 1) {
            return redirect()->back()->with('error', 'Book not available');
        }

        Borrowrecord::create([
            'user_id'     => Auth::id(),
            'book_id'     => $book->id,
            'borrow_date' => now(),
            'status'      => 'borrowed',
        ]);

        $book->decrement('quantity');

        return redirect()->back()->with('success', 'Book borrowed');
    }

    public function return(Book $book) {
        // FIXED: find Borrowrecord, NOT BorrowController
        $borrowing = Borrowrecord::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($borrowing) {
            $borrowing->update([
                'returned_at' => now(),
                'status'      => 'returned',
            ]);

            $book->increment('quantity');
        }

        return redirect()->back()->with('success', 'Book returned');
    }
//Update books
    public function edit(Book $book)
{
    return view('pages.books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'title'     => 'required|string|max:255',
        'author'    => 'required|string|max:255',
        'category'  => 'required|string|max:255',
        'isbn'      => 'required|string|unique:books,isbn,' . $book->id,
        'quantity'  => 'required|integer|min:1',
    ]);

    $book->update([
        'title'    => $request->title,
        'author'   => $request->author,
        'category' => $request->category,
        'isbn'     => $request->isbn,
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Book updated successfully');
}
//Delete books 
public function destroy(Book $book)
{
    $book->delete();
    return redirect()->route('admin.dashboard')->with('success', 'Book deleted successfully');
}

}
