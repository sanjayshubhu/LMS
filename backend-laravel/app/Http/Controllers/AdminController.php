<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowrecord;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Paginate 10 items per page for each section
        $books = Book::orderBy('title')->paginate(10);
        $users = User::orderBy('name')->paginate(10);
        $borrowRecords = Borrowrecord::with(['user', 'book'])
            ->orderBy('borrow_date', 'desc')
            ->paginate(10);

        // Determine which tab is active (default: books)
        $activeTab = $request->query('tab', 'books');

        return view('pages.dashboard.admin_dashboard.index', compact(
            'books',
            'users',
            'borrowRecords',
            'activeTab'
        ));
    }

    //Search books
    public function adminSearch(Request $request)
    {
        $query = $request->q ?? '';

        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->get(['id', 'title', 'quantity', 'author', 'category', 'isbn']);

        return response()->json($books);
    }

    public function books()
    {
        // Redirect to dashboard highlighting books tab
        return redirect()->route('admin.dashboard', ['tab' => 'books']);
    }

    public function users()
    {
        return redirect()->route('admin.dashboard', ['tab' => 'users']);
    }

    public function borrowRecords()
    {
        return redirect()->route('admin.dashboard', ['tab' => 'borrowRecords']);
    }
    //Delete users
    public function destroyUser(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
