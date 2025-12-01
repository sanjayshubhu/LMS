<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        // Get borrowed books for the logged-in user
        $borrowedBooks = auth()->user()->borrow()->get();

        // Get all books
        $books = Book::all();

        return view('pages.dashboard.user-dashboard', compact('borrowedBooks','books'));
    }
}
