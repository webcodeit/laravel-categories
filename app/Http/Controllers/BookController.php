<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookController extends Controller
{
       // Display a listing of the books
       public function index()
       {
           $books = Book::with('bookType')->get();
           return view('books.index', compact('books'));
       }
   
       // Show the form for creating a new book
       public function create()
       {
           $bookTypes = BookType::all();
           return view('books.create', compact('bookTypes'));
       }
   
       // Store a newly created book in storage
       public function store(Request $request)
       {
           $request->validate([
               'book_type_id' => 'required|exists:book_types,id',
               'title' => 'required|unique:books,title,NULL,NULL,book_type_id,' . $request->book_type_id,
            //    'title' => 'required',
               'author' => 'required',
               'year' => 'required|integer',
           ]);
   
           Book::create($request->all());
   
           return redirect()->route('books.index')->with('success', 'Book created successfully.');
       }
   
       // Show the form for editing the specified book
       public function edit(Book $book)
       {
           $bookTypes = BookType::all();
           return view('books.edit', compact('book', 'bookTypes'));
       }
   
       // Update the specified book in storage
       public function update(Request $request, Book $book)
       {
           $request->validate([
               'book_type_id' => 'required|exists:book_types,id',
               'title' => 'required|unique:books,title,' . $book->id . ',id,book_type_id,' . $request->book_type_id,
            //    'title' => 'required',
               'author' => 'required',
               'year' => 'required|integer',
           ]);
   
           $book->update($request->all());
   
           return redirect()->route('books.index')->with('success', 'Book updated successfully.');
       }
   
       // Remove the specified book from storage
       public function destroy(Book $book)
       {
           $book->delete();
   
           return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
       }
}
