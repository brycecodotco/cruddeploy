<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return view('books.index',['items'=>$books]);

    }

    public function store(Request $request)
    {
        Books::create([
            'book_name' => $request->book_name,
            'book_author' => $request->book_author,
            'book_stock' => $request->book_stock,
            'book_date' => $request->book_date
        ]);

        return redirect('/books')->with('success', 'New book has been added to the inventory!');
    }

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        return view('books.edit',[
            'item' => $book
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        $book->update([
            'book_name' => $request->book_name,
            'book_author' => $request->book_author,
            'book_stock' => $request->book_stock,
            'book_date' => $request->book_date
        ]);

        return redirect('/books')->with('update', 'Book details updated successfully!');
    }

    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();
        return redirect('/books')->with('delete', 'Book has been removed.');
    }
}
