@extends('layouts.admin')

@section('title','Add New Publisher')
@section('module','Publishers')
@section('content')

<div class="row">
 <div class="col-sm-8 col-sm-offset-2">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Creating New Publisher</h4>
            <p class="category">Fill in the fields to create a new Publisher</p>
        </div>
        <div class="box-body">
            @include('layouts.partials.messages')

            <form action="{{ route('publishers.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="Create Publisher">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection