<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
//use Redirect;

class BankController extends Controller
{
    public function index(Request $request){
         $banks = Bank::orderBy('id','DESC')->paginate(5);

        return view('bank.index',compact('banks'))

            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(){
        return view('bank.add');
    }

    public function store(Request $request){
        //Rules
        $rules = [
            'name' => 'required'
        ];

        //validate rules
        $this->validate($request,$rules);
      /*  $this->validate($request, [
            'name' => 'required',
        ]);*/

        bank::create($request->all());

        return redirect()->route('bank.index')
            ->with('success','Bank created successfully');
    }

    public function show(Bank $bank){

    }

    public function edit(Bank $bank){

    }

    public function update(Request $request){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFee($id){
        $fee = Fee::find($id);
        $fee->delete();

        \Session::flash('flash_message', 'Fee successfully Deleted!');

        return redirect()->back();
    }
}
