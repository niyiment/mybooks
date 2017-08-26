@extends('layouts.admin')

@section('title','Edit Borrower')
@section('module','Borrowers')
@section('content')

<div class="row">
 <div class="col-sm-8 col-sm-offset-2">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Edit Existing Borrower</h4>
            <p class="category">Fill in the fields to create a new borrower</p>
        </div>
        <div class="box-body">
            @include('layouts.partials.messages')

            <form action="{{ route('borrowers.update',$borrower) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Book</label>
                    <select name="book_id" id="book_id" class="form-control">
                        <option value="">Select Book</option>
                        @foreach ($books as $key => $value)
                            <option value="{{$key}}" {{ old('book_id', $borrower->book_id) == $key ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Customer</label>
                    <select name="customer_id" id="author_id" class="form-control">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $key => $value)
                            <option value="{{$key}}" {{ old('customer_id', $borrower->customer_id) == $key ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Issued Date</label>
                    <input type="date" class="form-control" name="issued_at" id="issued_at" value="{{ old('issued_at', $borrower->issued_at) }}">
                </div>
                <div class="form-group">
                    <label>Return Date</label>
                    <input type="date" class="form-control" name="return_at" id="return_at" value="{{ old('return_at',$borrower->return_at) }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Borrowed" {{ old('status', $borrower->status) == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                        <option value="Returned" {{ old('status', $borrower->status) == 'Returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="Update Borrower">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection