<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowrecord;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard() {
    $books = Book::all();
    $users = User::all();
    $borrowRecords = Borrowrecord::with(['user', 'book'])->get();
    return view('pages.dashboard.admin-dashboard', compact('books', 'users', 'borrowRecords'));
}

}
