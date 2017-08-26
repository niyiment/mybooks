<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\User;

class ProductController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	$products = Product::all();

    	return view('product.index',['products' =>$products]);
    }

    //display the create product form

    public function create(){
    	return view('product.create');
    }

    public function store(Request $request){
    	//Rules
        $rules = [
            'name' => 'required|unique:products',
            'product_key' => 'required|unique:products',
            'status' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ];

        //validate rules
        $this->validate($request,$rules);

		$product = new Product;
		$product->user_id = Auth::user()->id;
		$product->name = $request->name;
		$product->product_key = $request->product_key;
		$product->status = $request->status;
		$product->price = $request->price;
		$product->quantity = $request->quantity;

	    if ($product->save()){
	        return redirect()->route('products.index')
	            ->with('success','Product created successfully');
	    } else{
	    	return redirect()->route('products.create')
	    		->withError('Whoops! Something went wrong. Record not saved, try again later.');
	    }
    }

    public function edit(Product $product){
    	return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
    	//Rules
        $rules = [
            'name' => 'required',
            'product_key' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ];

        //validate rules
        $this->validate($request,$rules);

		$product->user_id = Auth::user()->id;
		$product->name = $request->name;
		$product->product_key = $request->product_key;
		$product->status = $request->status;
		$product->price = $request->price;
		$product->quantity = $request->quantity;

	    if ($product->save()){
	        return redirect()->route('products.index')
	            ->with('success','Product updated successfully');
	    } else{
	    	return redirect()->route('products.edit',$product)
	    		->withError('Whoops! Something went wrong. Record not saved, try again later.');
	    }

    }

    public function destroy(Product $product){
    	$product->delete();

    	return redirect()->route('products.index')
	      	->with('success','Product removed successfully');
    }
}
