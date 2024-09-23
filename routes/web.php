<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MultipleBook;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\StudentBook;
use App\Http\Controllers\StudentBookController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('faculty', FacultyController::class)->names('faculty');
    Route::resource('book', BookController::class)->names('book');
    Route::resource('student', StudentController::class)->names('student');

    Route::post('/books/create', [MultipleBook::class, 'createMultipleBooks'])->name('books.createMultiple');
    Route::resource('student-book', StudentBookController::class)->names([
        'index'   => 'student-book.index',

    ]);

    // In web.php

    Route::get('/test-search', [StudentBookController::class, 'search'])->name('test-search');
    Route::get('/student-book/create/{id}', [StudentBookController::class, 'create'])->name('student_book.create');
    Route::get('/book-search', [StudentBookController::class, 'searchBooks'])->name('book-search');
    Route::get('/store-book/{book_id}/{student_id}', [StudentBookController::class, 'storeBooks'])->name('book-store');




    // Add these routes to handle the renew and return actions
    Route::get('/student-book/renew/{student}', [StudentBookController::class, 'renew'])->name('student-book.renew');
    Route::get('/student-book/return/{student}', [StudentBookController::class, 'return'])->name('student-book.return');

    Route::get('/return-book', [StudentBookController::class, 'returnBooks'])->name('returnBooks');
    Route::get('/test-search-search', [StudentBookController::class, 'searchSearch'])->name('test-search-search');
    Route::get('/test-search-book-return', [ReturnBookController::class, 'searchBooks'])->name('test-search-book-return');
});

require __DIR__ . '/auth.php';
