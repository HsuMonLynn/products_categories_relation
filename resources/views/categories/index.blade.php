@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success row">
                <p style="margin: 0" class="col-md-11">{{ $message }}</p>
                <button type="button" class="close col-md-1" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="row justify-content-end">×</span>
                </button>
            </div>
        @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-success " href="{{ route('categories.create') }}"> Create New Category</a>
                        </div>
                        <div class="col-md-6 ml-auto pl-5">
                            <div class="input-group mb-3 justify-content-end">
                                <form class="form-inline row ml-3" action="{{route('categories.index')}}" method="GET">
                                    <input class="form-control mr-sm-2" type="search" name="search"
                                        value="{{request('search')}}" />
                                    <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th >No</th>
                            <th >Name</th>
                            <th >Action</th>
                        </tr>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                                        <a class="btn btn-outline-info mr-3" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h4 class="text-info row justify-content-center">No categories found.</h4>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection