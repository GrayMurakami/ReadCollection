<?php

namespace App\Http\Controllers\Manager;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookStatisticsGraphsController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $booksCount = $books->count();
        $authorsCount = $books->groupBy('author')->count();
        $genresCount = $books->groupBy('genre')->count();

        return view('bookManager.statisticsGraphs', [
            'booksCount' => $booksCount,
            'authorsCount' => $authorsCount,
            'genresCount' => $genresCount,
        ]);
    }
}
