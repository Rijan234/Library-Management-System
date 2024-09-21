<?php 

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MultipleBook extends Controller
{
    public function createMultipleBooks(Request $request)
    {
        // return "hello";
        // Directly retrieve the data from the request without validation
        $data = $request->all();
        // return $data;

        $books = [];
        for ($i = 0; $i < $data['book_quantity']; $i++) {
            $books[] = [
                'name' => $data['book_name'],
                'author' => $data['book_author'],
                'price' => $data['book_price'],
                'uuid' => generateReadableId(), // Generate a unique UUID for each copy
               
            ];
        }

        // Insert all book copies into the database
        Book::insert($books);

        
        $stock = new Stock();
        $stock->book_name = $request->book_name;
        $stock->quantity = $request->book_quantity;
        $stock->save();

        // return response()->json([
        //     'message' => $data['book_quantity'] . ' copies of "' . $data['book_name'] . '" created successfully.',
        // ]);
        // return "hello";
        return redirect()->route('book.index')->with('success', 'Book added successfully.');
    }
}
