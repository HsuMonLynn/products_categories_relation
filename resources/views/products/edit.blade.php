@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> Update Product Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                        class="form-control @error('name')
                                is-invalid @enderror"
                                        placeholder="Name">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger text-bold">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Categories</strong>
                                        <select name="categories_id[]" class="form-control @error('categories_id[]')
                                        is-invalid @enderror" multiple>
                                        <option >Choose...</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    @if($productCategories->contains($category->id)) selected @endif>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('categories_id'))
                                            <span class="error text-danger text-bold">{{ $errors->first('categories_id') }}</span>
                                        @endif
                                    </div>

                            <div class="row col-12 pt-3 pb-3">
                                <div class="col-md-4">
                                    <a class="btn btn-secondary" href="{{ route('products.index') }}"> Back</a>
                                </div>
                                <div class="col-md-4 ml-auto">
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection