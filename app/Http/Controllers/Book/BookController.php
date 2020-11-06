<?php

namespace App\Http\Controllers\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();

        $count = count($books);

        return view('books.books', ['books' => $books, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        //
        $author = $request->author;
        $title = $request->title;
        $description = $request->description;
        $publisher = $request->publisher;
        $date_published = $request->date_published;

        $cover_extension = $request->file('front_cover')->extension();
        $front_cover = $request->file('front_cover')->storeAs('covers', uniqid().'.'.$cover_extension, 'public');

        $file_extension = $request->file('file')->extension();
        $path = $request->file('file')->storeAs('books', uniqid().".".$file_extension, 'public');

        $new_book = Book::create([
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'publisher' => $publisher,
            'date_published' => $date_published,
            'path' => $path,
            'front_cover' => $front_cover
        ]);

        if ($new_book == false) {
            # code...
            $response = [
                'status' => '0',
                'msg' => 'Error saving book into inventory'
            ];

            return response()->json($response, 200);
        }

        $response = [
            'status' => '1'
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}