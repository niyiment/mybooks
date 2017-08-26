<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Models\Publisher;

class PublisherController extends Controller
{

    /**
     *
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('publisher.index', [
            'publishers' => $publishers,
        ]);
    }

    /**
     *
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     *
     */
    public function store(Request $request)
    {
        //Rules
        $rules = [
            'name' => 'required',
            'email'=> 'email|unique:publishers'
        ];

        //validate rules
        $this->validate($request,$rules);
    
        $publisher = new Publisher;
        $publisher->user_id = Auth::user()->id;
        $publisher->name = $request->name;        
        $publisher->phone = $request->phone;
        $publisher->email = $request->email;

        if ($publisher->save()){
            return redirect()->route('publishers.index')
                ->with('success','Publisher created successfully');
        } else{
            return redirect()->route('publishers.create')
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     *
     */
    public function edit(Publisher $publisher)
    {
       // $publisher = Publisher::where('id', $publisherId)->first();

        // validation
        if(! $publisher) {
            return redirect()->back()->withErrors('The Publisher you are looking for does not exist');
        }

        return view('publisher.edit', [
            'publisher' => $publisher
        ]);
    }

    /**
     *
     */
    public function update(Request $request, Publisher $publisher)
    {
        //$publisher = Publishers::find($id);
        $publisher->user_id = Auth::user()->id;
        $publisher->name = $request->name;
        $publisher->phone = $request->phone;
        $publisher->email = $request->email;

        if ($publisher->save()){
            return redirect()->route('publishers.index')
                ->with('success','Publisher updated successfully');
        } else{
            return redirect()->route('publishers.edit',$publisher)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    public function destroy(Publisher $publisher)
    {
        // @TODO: fire events to remove projects and contacts
        $publisher->delete();

        return redirect()->back()->with('success', ['The Publisher and all their information has been deleted successfully']);
    }
}
