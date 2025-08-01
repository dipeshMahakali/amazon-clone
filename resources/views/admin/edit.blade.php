@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 align='center'>Update Product Data</h1>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('updateProduct')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="productName" class="col-md-3">Product Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('productname') is-invalid @enderror"
                                id="productName" name="productname" placeholder="Enter Product" value="{{$product->name}}">
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
                            <input type="text" class="form-control w-50 @error('productcategory') is-invalid @enderror"
                                id="productCategory" name="productcategory" placeholder="Enter Product Category"
                                value="{{$product->category_id}}">
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
                                id="productPrice" name="productprice" placeholder="Enter Product Price"
                                value="{{$product->price}}">
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
                                id="productImage" name="productimage" placeholder="Select Product Image"
                                value="{{$product->image_link}}">
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
                                id="description" name="productdescription" placeholder="Enter Product Description"
                                value="{{$product->description}}">
                            @error('productdescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection