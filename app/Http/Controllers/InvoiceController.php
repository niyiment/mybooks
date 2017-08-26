<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Client;

class InvoiceController extends Controller
{

    /**
     *
     */
    public function index()
    {
        return view('invoices.index', [
            'invoices' => Invoice::all(),
        ]);
    }

    /**
     *
     */
    public function create()
    {
        return view('invoice.create', [
            'clients' => Client::getSelectbox(),
            'products' => Product::getSelectbox(),
        ]);
    }

    public function store(Request $request)
    {
        // rules
        $rules = [
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required',
        ];

        // validate
        $this->validate($request, $rules);

        // validation passed
        Invoice::create($request->only(['project_id', 'amount', 'due_at']));

        // return
        return redirect()->route('invoice')->with('success', ['The invoice was created']);
    }

}
