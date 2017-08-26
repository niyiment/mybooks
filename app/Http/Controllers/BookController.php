<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\Book;
use App\Models\Author;
//use App\Models\Publisher;

class BookController extends Controller
{

    /**
     *
     */
    public function index()
    {
        $books = Book::all();
    	/*$books = DB::table('books')
    		->join('authors','authors.id','=','books.author_id')
    		->join('publishers','publishers.id','=','books.publisher_id')
    		->select('books.*','authors.name as author','publishers.name as publisher')
    		->get();*/

        return view('book.index', [
            'books' => $books,
        ]);
    }

    
    /**
     *
     */
    public function create()
    {
        return view('book.create',
            ['authors' => Author::getSelectbox(),
            ]);
    }

    /**
     *
     */
    public function store(Request $request)
    {
        //Rules
        $rules = [
        	'author_id' =>'required|numeric',
        //	'publisher_id' =>'required|numeric',
            'title' => 'required',
            'edition' => 'required',
            'status' => 'required'
        ];

        //validate rules
        $this->validate($request,$rules);
    
        $book = new Book;
        $book->user_id = Auth::user()->id;
        $book->author_id = $request->author_id;        
       // $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->edition = $request->edition;
        $book->status = $request->status;

        if ($book->save()){
            return redirect()->route('books.index')
                ->with('success','Book created successfully');
        } else{
            return redirect()->route('books.create')
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     *
     */
    public function edit(Book $book)
    {
       // $book = Book::where('id', $bookId)->first();

        // validation
        if(! $book) {
            return redirect()->back()->withErrors('The book you are looking for does not exist');
        }

        return view('book.edit', [
            'book' => $book,
            'authors' => Author::getSelectbox(),
       //     'publishers' => Publisher::getSelectbox()
        ]);
    }

    /**
     *
     */
    public function update(Request $request, Book $book)
    {
        //$book = books::find($id);
        $book->user_id = Auth::user()->id;
        $book->author_id = $request->author_id;        
       // $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->edition = $request->edition;
        $book->status = $request->status;

        if ($book->save()){
            return redirect()->route('books.index')
                ->with('success','Book updated successfully');
        } else{
            return redirect()->route('books.edit',$book)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    public function destroy(Book $book)
    {
        // @TODO: fire events to remove projects and contacts
        $book->delete();

        return redirect()->back()->with('success', ['The book and all their information has been deleted successfully']);
    }
}
