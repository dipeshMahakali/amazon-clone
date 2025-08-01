@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 align='center'>Add New Location</h1>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('storeLocation')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="locationName" class="col-md-3">Location Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control w-50  @error('locationname') is-invalid @enderror"
                                id="locationName" name="locationname" placeholder="Enter Location">
                            @error('locationname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-2 row">
                        <label for="pricePercentage" class="col-md-3">Price Percentage</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control w-50  @error('pricepercentage') is-invalid @enderror"
                                id="pricePercentage" name="pricepercentage" placeholder="Enter Percentage Value">
                            @error('pricepercentage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Location</button>
            </form>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
    </div>
@endsection
