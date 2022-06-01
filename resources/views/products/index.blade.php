@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                            <a class="btn btn-success " href="{{ route('products.create') }}"> Create New Product</a>
                        </div>
                        <div class="col-md-6 ml-auto pl-5">
                            <div class="input-group mb-3 justify-content-end">
                                <form class="form-inline row ml-3" action="{{route('products.index')}}" method="GET">
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
                            <th >Product</th>
                            <th >Category</th>
                            <th> Date </th>
                            <th >Action</th>
                        </tr>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>@foreach($product->categories as $category){{ $category->name  }}<br>@endforeach</td>
                                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                        <a class="btn btn-outline-info mr-3" href="{{ route('products.edit',$product->id) }}">Edit</a>
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
                                    <h4 class="text-info row justify-content-center">No products found.</h4>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection