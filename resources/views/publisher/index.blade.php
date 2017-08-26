@extends('layouts.admin')

@section('title','Publisherr Lists')
@section('module','Publishers')
@section('content')
  
<div class="row">
 <div class="col-md-12">
 @include('layouts.partials.messages')
<div class="box box-info">
<div class="box-header with-border">
    <h4 class="title">
    <div class="pull-right">
        <a href="{{route('publishers.create')}}" class="btn btn-primary btn-sm btn-simple">
            <i class="fa fa-plus"></i>Add Publisher
        </a>
    </div>
    </h4>
    <p class="category">All Publishers are shown here</p>
</div>
<div class="box-body">
    <div class="content table-responsive table-full-width"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email Address
                    </th>
                    <th>
                        Phone Number
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($publishers as $publisher)
                    <tr>
                        <td>
                            {{ $publisher->name }}
                        </td>
                        <td>
                            {{ $publisher->email }}
                        </td>
                        <td>
                            {{ $publisher->phone }}
                        </td>
                        <td class="td-actions text-right">
                            <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-success btn-simple btn-sm">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="{{ route('publishers.destroy', $publisher) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-simple btn-sm">
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