<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use DB;
use Excel;
use App\User;
use App\Models\Book;
use App\Models\Customer;
use App\Models\Borrower;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $borrowers = Borrower::all();

        return view('borrower.index', [
            'borrowers' => $borrowers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('borrower.create',
            [   'books' => Book::getSelectbox(),
                'customers' => Customer::getSelectbox(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $borrower = new Borrower;
        $borrower->user_id = Auth::user()->id;
        $borrower->book_id = $request->book_id;        
        $borrower->customer_id = $request->customer_id;
        $borrower->issued_at = $request->issued_at;
        $borrower->return_at = NULL;
        $borrower->status = $request->status;

        if ($borrower->save()){
            $book = Book::find($request->book_id);
            if ($request->status == 'Returned'){
                $book->status = 'Available';
            } else{
                $book->status = $request->status;
            }
               
            $book->save();

            return redirect()->route('borrowers.index')
                ->with('success','Borrower updated successfully');
        } else{
            return redirect()->route('borrowers.edit',$borrower)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function show(Borrower $borrower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrower $borrower)
    {
        // validation
        if(! $borrower) {
            return redirect()->back()->withErrors('The borrower you are looking for does not exist');
        }

        return view('borrower.edit', [
            'borrower' => $borrower,
            'books' => Book::getSelectbox(),
            'customers' => Customer::getSelectbox(),
        ]);
    }

    public function exportToExcel(){
        //
        $borrowers = Borrower::select('id','book_id','customer_id','status','issued_at','return_at')->get();
        Excel::create('Borrowers', function ($excel) use($borrowers){
            //$excel->sheet()
            /*//set title
            $excel->setTitle('List of Borrowers');

            //Chain the setters
            $excel->setCreator('Niyiment')
                ->setCompany('Niyiment Solutions');

            //call them separately
            $excel->setDescription('A demonstration to change the file properties');
            */
            $excel->sheet('Borrowers Sheet', function ($sheet) use($borrowers){
                $sheet->fromArray($borrowers);
            });
        })->export('xls');
    }

    public function exportExcel(){
        $borrowers = Borrower::join('books', 'books.id', '=', 'borrowers.book_id')
            ->join('customers','customers.id','=','borrowers.customer_id')
            ->select(
            //  \DB::raw("concat(users.first_name, ' ', users.last_name) as `name`"), 
              'books.title', 
              'customers.name',
              'borrowers.status', 
              'borrowers.issued_at')
            ->get();

         // Initialize the array which will be passed into the Excel
        // generator.
        $borrowersArray = []; 

        // Define the Excel spreadsheet headers
        $borrowersArray[] = ['book', 'customer','status','Date'];

        // Convert each member of the returned collection into an array,
        // and append it to the borrowers array.
        foreach ($borrowers as $borrower) {
            $borrowersArray[] = $borrower->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('borrowers', function($excel) use ($borrowersArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('borrowers');
            $excel->setCreator('Niyiment')->setCompany('Niyiment Solutions');
            $excel->setDescription('Borrowers List');

            // Build the spreadsheet, passing in the borrowers array
            $excel->sheet('sheet1', function($sheet) use ($borrowersArray) {
                $sheet->fromArray($borrowersArray, null, 'A1', false, false);
            });

        })->download('xlsx');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrower $borrower)
    {
        
        $borrower->user_id = Auth::user()->id;
        $borrower->book_id = $request->book_id;        
        $borrower->customer_id = $request->customer_id;
        $borrower->issued_at = $request->issued_at;
        $borrower->return_at = $request->return_at;
        $borrower->status = $request->status;

        if ($borrower->save()){
             $book = Book::find($request->book_id);
            if ($request->status == 'Returned'){
                $book->status = 'Available';
            } else{
                $book->status = $request->status;
            }

            $book->save();

            return redirect()->route('borrowers.index')
                ->with('success','Borrower updated successfully');
        } else{
            return redirect()->route('borrowers.edit',$borrower)
                ->withError('Whoops! Something went wrong. Record not saved, try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrower $borrower)
    {
        //
        $borrower->delete();

        return redirect()->back()->with('success', ['The borrower and all their information has been deleted successfully']);
    }
}
