<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class StudentBookController extends Controller
{
    public function index()
    {
        return view('student_book.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $books = Book::where('student_id', $id)->get(); // Adjust based on your logic
        return view('student_book.show', compact('student', 'books'));
    }

    public function create(string $id)
    {
        $student = Student::find($id);
        // $a = $student->books;
        // return $a;
        return view('student_book.create', compact('student'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $students = Student::where('name', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->get();

        if ($request->ajax()) {
            $html = view('student_book.index', compact('students'))->render();
            $searchResultsHtml = $this->extractSearchResultsHtml($html);
            return response()->json(['html' => $searchResultsHtml]);
        }

        return view('student_book.index', compact('students'));
    }



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


    public function searchBooks(Request $request)
    {
        $studentId = $request->input('student_id');
        $query = $request->input('query');
        $books = Book::where('name', 'LIKE', "%{$query}%")
            ->orWhere('uuid', 'LIKE', "%{$query}%")
            ->get();
        if ($request->ajax()) {
            $html = view('student_book.book_results', compact('books', 'studentId'))->render();
            return response()->json(['html' => $html]);
        }

        // If not an AJAX request, return the full view
        return view('student_book.create', compact('books',));
    }


    public function storeBooks($book_id, $student_id)
    {
        // Find the student by ID
        $student = Student::find($student_id);

        if ($student) {
            // Current timestamp for created_at
            $createdAt = Carbon::now();
            $book = Book::find($book_id);

            // Add 5 days to the current timestamp for expiry_date
            $expiryDate = $createdAt->copy()->addDays(5);

            // Attach the book to the student with created_at and expiry_date
            $student->books()->attach($book_id, [
                'created_at' => $createdAt,
                'updated_at' => $createdAt, // Optional if you want to set updated_at as well
                'expiry_date' => $expiryDate,
                'book_uuid' => $book->uuid 
            ]);

            return redirect()->back();
        } else {
            return "Student not found.";
        }
    }


    public function return($student_id, Request $request)
    {
        // Retrieve the comma-separated book IDs from the query parameter
        $bookIds = explode(',', $request->query('books'));

        // Find the student by ID
        $student = Student::find($student_id);

        if ($student) {
            // Detach all the books associated with the student
            if (empty($bookIds) || $bookIds[0] === '') {
                // Detach all books if no specific book IDs are provided
                $student->books()->detach();
            } else {
                // Detach only the specified books
                $student->books()->detach($bookIds);
            }

            return redirect()->back()->with('status', 'Books successfully detached.');
        } else {
            return "Student not found.";
        }
    }


    public function renew($student_id, Request $request)
    {
        // Retrieve the comma-separated book IDs from the query parameter
        $bookIds = explode(',', $request->query('books'));

        // Find the student by ID
        $student = Student::find($student_id);

        if ($student) {
            // Loop through each book ID and attach it with the desired timestamps
            foreach ($bookIds as $bookId) {
                // Current timestamp for created_at
                $createdAt = Carbon::now();

                // Add 5 days to the current timestamp for expiry_date
                $expiryDate = $createdAt->copy()->addDays(5);

                // Attach the book to the student with created_at and expiry_date
                $student->books()->updateExistingPivot($bookId, [
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt, // Optional if you want to set updated_at as well
                    'expiry_date' => $expiryDate
                ]);
            }

            return redirect()->back();
        } else {
            return "Student not found.";
        }
    }

    public function returnBooks(){
        return view('student_book.return');
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
