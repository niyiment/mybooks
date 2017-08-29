
@extends('layouts.admin')

@section('title','Book Lists')
@section('module','Books')
@section('content')

<div class="row">
 <div class="col-md-12">
 @include('layouts.partials.messages')
<div class="box box-info">
<div class="box-header with-border">
    <h4 class="title">
    <div class="pull-right">
        <a href="{{route('books.create')}}" class="btn btn-primary btn-sm btn-simple">
            <i class="fa fa-plus"></i>Add Book
        </a>
    </div>
    </h4>
    <p class="category">All Books are shown here</p>
</div>
<div class="box-body">
    <div class="content table-responsive table-full-width"> 
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>
                        ISBN
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Author
                    </th>
                    <th>
                        Status
                    </th>
                    <th class="text-center">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>
                            {{ $book->isbn }}
                        </td>
                        <td>
                            {{ $book->title }}
                        </td>
                        <td>
                            {{ $book->author->name }}
                        </td>
                        <td>
                            {{ $book->status }}
                        </td>   
                        <td class="td-actions text-right">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-success btn-simple btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{ route('books.destroy', $book->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-simple btn-sm">
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