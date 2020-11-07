<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $book_count = Book::all()->count();
        $archived_books_count = Book::onlyTrashed()->count();
        return view('dashboard', ['book_count' => $book_count, 'archived_books_count' => $archived_books_count]);
    }
}