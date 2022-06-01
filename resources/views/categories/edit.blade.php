@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> Update Category Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update',$category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                        class="form-control @error('name')
                                is-invalid @enderror"
                                        placeholder="Name">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger text-bold">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-12 pt-3 pb-3">
                                <div class="col-md-4">
                                    <a class="btn btn-secondary" href="{{ route('categories.index') }}"> Back</a>
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