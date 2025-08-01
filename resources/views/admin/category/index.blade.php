@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 align='center'>Add New Category</h1>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('storeCategory')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="categoryName" class="col-md-3">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('categoryname') is-invalid @enderror"
                                id="categoryName" name="categoryname" placeholder="Enter Category">
                            @error('categoryname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
    </div>
@endsection
