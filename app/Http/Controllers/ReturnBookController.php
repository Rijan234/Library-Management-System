<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\StudentBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnBookController extends Controller
{


    protected function extractSearchResultsHtml($html)
    {
        // Extract only the search results section from the HTML
        $start = strpos($html, '<!-- START SEARCH RESULTS -->');
        $end = strpos($html, '<!-- END SEARCH RESULTS -->');

        if ($start !== false && $end !== false) {
            $start += strlen('<!-- START SEARCH RESULTS -->');
            return substr($html, $start, $end - $start);
        }

        return '';
    }

    // public function searchBooks(Request $request)
    // {
    //     $query = $request->input('query');
    //     // return $query;
    //     $books = Student::where('book_uuid', 'LIKE', "%{$query}%")
    //         ->get();
    //     if ($request->ajax()) {
    //         $html = view('student_book.book_results', compact('books'))->render();
    //         return response()->json(['html' => $html]);
    //     }

    //     // If not an AJAX request, return the full view
    //     return view('student_book.create', compact('books'));
    // }
    public function searchBooks(Request $request)
    {
        $query = $request->input('query');
    
        // Search books through the pivot table relationship
        $students = Student::whereHas('books', function ($q) use ($query) {
            $q->where('books.uuid', 'LIKE', "%{$query}%");
        })->with(['books' => function ($q) use ($query) {
            $q->where('books.uuid', 'LIKE', "%{$query}%");
        }])->get();
    
        // Flatten the collection to get unique books and extract the student ID from the pivot table
        $books = $students->flatMap(function ($student) {
            return $student->books->map(function ($book) use ($student) {
                $book->student_id = $student->id; // Add the student ID to each book item
                return $book;
            });
        })->unique('id');
    
        // Extract student names, filtering out empty names and join them into a string
        $studentNames = $students->pluck('name')->filter()->unique()->implode(', ');
    
        // Handle AJAX request
        if ($request->ajax()) {
            $html = view('student_book.return_book_results', compact('books', 'studentNames'))->render();
            return response()->json(['html' => $html]);
        }
    
        // Return full view if not AJAX
        return view('student_book.create', compact('books', 'studentNames'));
    }
    
    
    
    


    

    public function searchSearch(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('uuid', 'LIKE', "%{$query}%")
            
            ->get();

        if ($request->ajax()) {
            $html = view('student_book.return', compact('books'))->render();
            $searchResultsHtml = $this->extractSearchResultsHtml($html);
            return response()->json(['html' => $searchResultsHtml]);
        }

        return view('student_book.return', compact('books'));
    }
}
