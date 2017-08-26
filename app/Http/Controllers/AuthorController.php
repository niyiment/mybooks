<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Models\Author;
/*use App\Http\Requests\Authors\AuthorStore;
use App\Http\Requests\Authors\AuthorUpdate;*/

class AuthorController extends Controller
{

    /**
     *
     */
    public function index()
    {
        $authors = Author::all();

        return view('author.index', [
            'authors' => $authors,
        ]);
    }

    /**
     *
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     *
     */
    public function store(Request $request)
    {
        //Rules
        $rules = [
            'name' => 'required',
        ];

        //validate rules
        $this->validate($request,$rules);
    
        $author = new Author;
        $author->user_id = Auth::user()->id;
        $author->name = $request->name;

        if ($author->save()){
            return redirect()->route('authors.index')
                ->with('success','Author created successfully');
        } else{
            return redirect()->route('authors.create')
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     *
     */
    public function edit(Author $author)
    {
       // $author = Author::where('id', $authorId)->first();

        // validation
        if(! $author) {
            return redirect()->back()->withErrors('The Author you are looking for does not exist');
        }

        return view('author.edit', [
            'author' => $author
        ]);
    }

    /**
     *
     */
    public function update(Request $request, Author $author)
    {
        //$author = Author::find($id);
        $author->user_id = Auth::user()->id;
        $author->name = $request->name;

        if ($author->save()){
            return redirect()->route('authors.index')
                ->with('success','Author updated successfully');
        } else{
            return redirect()->route('authors.edit',$author)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    public function destroy(Author $author)
    {
        // @TODO: fire events to remove projects and contacts
        $author->delete();

        return redirect()->back()->with('success', ['The Author and all their information has been deleted successfully']);
    }
}
