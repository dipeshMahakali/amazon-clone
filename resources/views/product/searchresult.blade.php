@extends('layout.app')
@section('content')
    <div class="container bg-white p-3 rounded shadow-sm">
        <div class="mb-3">
            <h5 class="fw-bold border-bottom pb-2">Search Results</h5>
        </div>

        <div class="card mb-3 border-0 shadow-sm" style="max-width: 100%;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/storage/{{$product->image_link}}"
                        class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{$product->name}}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{$product->name}}</h5>
                        <p class="card-text text-success fw-semibold mb-1">₹{{$product->adjusted_price}}</p>

                        <div class="mb-2">
                            <!-- Rating (static example with 4 out of 5 stars) -->
                            <span class="text-warning">
                                ★★★★☆
                            </span>
                            <small class="text-muted ms-2">(142 reviews)</small>
                        </div>

                        <p class="card-text text-muted small">{{$product->description}}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#logout').hide();
    });
</script>