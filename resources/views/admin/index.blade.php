@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 align='center'>Add New Product</h1>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('storeProduct')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="productName" class="col-md-3">Product Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('productname') is-invalid @enderror"
                                id="productName" name="productname" placeholder="Enter Product">
                            @error('productname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="productCategory" class="col-md-3">Product Category</label>
                        <div class="col-md-9">
                            <select class="form-control w-50 @error('productcategory') is-invalid @enderror"
                                id="productCategory" name="productcategory">
                                <option value="">Select Category</option>
                                @foreach ($category as $catgory)
                                    <option value={{$catgory->id}}>{{$catgory->category_name}}</option>
                                @endforeach
                            </select>
                            @error('productcategory')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="productPrice" class="col-md-3">Product Price</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('productprice') is-invalid @enderror"
                                id="productPrice" name="productprice" placeholder="Enter Product Price">
                            @error('productprice')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="productImage" class="col-md-3">Product Image</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control w-50  @error('productimage') is-invalid @enderror"
                                id="productImage" name="productimage" placeholder="Select Product Image">
                            @error('productimage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="description" class="col-md-3">Description</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('productdescription') is-invalid @enderror"
                                id="description" name="productdescription" placeholder="Enter Product Description">
                            @error('productdescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
            </form>
        </div>
    </div>
@endsection