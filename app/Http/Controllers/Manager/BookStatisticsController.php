<?php

namespace App\Http\Controllers\Manager;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookStatisticsController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $booksCount = $books->count();
        $authorsCount = $books->groupBy('author')->count();
        $genresCount = $books->groupBy('genre')->count();
        $latestBook = $books->sortByDesc('created_at')->first();
        $newestBook = $books->sortByDesc('publication_date')->first();
        $oldestBook = $books->sortBy('publication_date')->first();
        $latestAddedBook = $books->sortByDesc('created_at')->first();
        $latestEditedBook = $books->sortByDesc('updated_at')->first();
        $latestDeletedBook = $books->sortByDesc('deleted_at')->first();
        $mostPopularAuthor = $books->groupBy('author')->sortByDesc(function ($group) {
            return $group->count();
        })->keys()->first();
        $mostPopularGenre = $books->groupBy('genre')->sortByDesc(function ($group) {
            return $group->count();
        })->keys()->first();

        return view('bookManager.statistics', compact(
            'booksCount',
            'authorsCount',
            'genresCount',
            'latestBook',
            'newestBook',
            'oldestBook',
            'latestAddedBook',
            'latestEditedBook',
            'latestDeletedBook',
            'mostPopularAuthor',
            'mostPopularGenre'
        ));
    }
}
