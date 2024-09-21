<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Stock::all();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
            $book = new Book();
            $book->name = $request->book_name;
            $book->author = $request->book_author;
            $book->quantity = $request->book_quantity;
            $book->price = $request->book_price;
    
            $book->save();
        return redirect()->route('book.index')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $book->name = $request->book_name;
        $book->author = $request->book_author;
        $book->quantity = $request->book_quantity;
        $book->price = $request->book_price;

        $book->update();
        return redirect()->route('book.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('book.index')->with('delete', 'Book deleted successfully.');

    }

}
