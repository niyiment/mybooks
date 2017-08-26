<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\Book;
use App\Models\Customer;

class CustomerController extends Controller
{

    /**
     *
     */
    public function index()
    {
        $customers = Customer::all();
    	/*$customers = DB::table('customers')
    		->join('books','books.id','=','customers.book_id')
    		->select('customers.*','books.title')
    		->get();*/

        return view('customer.index', [
            'customers' => $customers,
        ]);
    }

    /**
     *
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     *
     */
    public function store(Request $request)
    {
        //Rules
        $rules = [
        	'phone' => 'present',
            'name' => 'required',
        ];

        //validate rules
        $this->validate($request,$rules);
    
        $customer = new Customer;
        $customer->user_id = Auth::user()->id;      
        $customer->name = $request->name;
        $customer->phone = $request->phone;  
        
        if ($customer->save()){
            return redirect()->route('customers.index')
                ->with('success','Customer created successfully');
        } else{
            return redirect()->route('customers.create')
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     *
     */
    public function edit(Customer $customer)
    {
       // $customer = customer::where('id', $customerId)->first();

        // validation
        if(! $customer) {
            return redirect()->back()->withErrors('The Customer you are looking for does not exist');
        }

        return view('customer.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     *
     */
    public function update(Request $request, Customer $customer)
    {
        //$book = books::find($id);
        $customer->user_id = Auth::user()->id;
        $customer->phone = $request->phone;        
        $customer->name = $request->name;

        if ($customer->save()){
            return redirect()->route('customers.index')
                ->with('success','Customer updated successfully');
        } else{
            return redirect()->route('customers.edit',$customer)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    public function destroy(Customer $customer)
    {
        // @TODO: fire events to remove projects and contacts
        $customer->delete();

        return redirect()->back()->with('success', ['The customer and all their information has been deleted successfully']);
    }
}
