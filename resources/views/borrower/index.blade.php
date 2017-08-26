@extends('layouts.admin')

@section('title','Borrower Lists')
@section('module','Borrowers')
@section('content')

<div class="row">
 <div class="col-md-12">
 @include('layouts.partials.messages')
<div class="box box-info">
<div class="box-header with-border">
    <h4 class="title">
    <div class="pull-right">
        <a href="{{route('borrowers.create')}}" class="btn btn-primary btn-sm btn-simple">
            <i class="fa fa-plus"></i>Add Borrower
        </a>
    </div>
    </h4>
    <p class="category">All Borrowers are shown here</p>
</div>
<div class="box-body">
    <div class="content table-responsive table-full-width"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Book
                    </th>
                    <th>
                        Customer
                    </th>
                    <th>
                        Issued Date
                    </th>
                    <th>
                        Status
                    </th>
                    <th class="text-center">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowers as $borrower)
                    <tr>
                        <td>
                            {{ $borrower->book->title }}
                        </td>
                        <td>
                            {{ $borrower->customer->name }}
                        </td>
                        <td>
                            {{ $borrower->issued_at }}
                        </td>
                        <td>
                            {{ $borrower->status }}
                        </td>   
                        <td class="td-actions text-right">
                            <a href="{{ route('borrowers.edit', $borrower->id) }}" class="btn btn-success btn-simple btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{ route('borrowers.destroy', $borrower->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-simple btn-sm">
                                <i class="fa fa-close"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
</div>

@endsection