@extends('layouts.admin')

@section('title','Add New Book')
@section('module','Books')
@section('content')

<div class="row">
 <div class="col-sm-8 col-sm-offset-2">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Creating New Book</h4>
            <p class="category">Fill in the fields to create a new book</p>
        </div>
        <div class="box-body">
            @include('layouts.partials.messages')

            <form action="{{ route('books.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" class="form-control" name="isbn" id="isbn" value="{{ old('isbn') }}">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <select name="author_id" id="author_id" class="form-control">
                        <option value="">Select Author</option>
                        @foreach ($authors as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Edition</label>
                    <input type="text" class="form-control" name="edition" id="edition" value="{{ old('edition') }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Available">Available</option>
                        <option value="Borrowed">Borrowed</option>
                        <option value="Lost">Lost</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="Create Book">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection