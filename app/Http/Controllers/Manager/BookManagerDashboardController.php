<?php

namespace App\Http\Controllers\Manager;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookManagerDashboardController extends Controller
{
    public function bookManager()
    {
        return view('bookManager.bookManagerDashboard');
    }

    public function contactWithAdmin()
    {
        return view('bookManager.contactWithAdmin');
    }

    public function index()
    {
        $books = Book::all();
        $booksCount = $books->count();
        return view('bookManager.bookManagerDashboard', compact('books', 'booksCount'));
    }
}
