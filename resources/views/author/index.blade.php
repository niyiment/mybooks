@extends('layouts.admin')

@section('title','Author Lists')
@section('module','Authors')
@section('content')
  
<div class="row">
 <div class="col-md-12">
 @include('layouts.partials.messages')
<div class="box box-info">
<div class="box-header with-border">
    <h4 class="title">
    <div class="pull-right">
        <a href="{{route('authors.create')}}" class="btn btn-primary btn-sm btn-simple">
            <i class="fa fa-plus"></i>Add Author
        </a>
    </div>
    </h4>
    <p class="category">All Authors are shown here</p>
</div>
<div class="box-body">
    <div class="content table-responsive table-full-width"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th class="text-center">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>
                            {{ $author->name }}
                        </td>
                        <td class="td-actions text-right">
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-success btn-simple btn-sm">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="{{ route('authors.destroy', $author) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-simple btn-sm">
                                <i class="fa fa-close"></i> Remove
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