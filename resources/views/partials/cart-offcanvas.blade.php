@if(session('cart'))
    @foreach(session('cart') as $id => $details)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $details['image']) }}" class="productimage img-fluid rounded-start"
                        alt="{{ $details['name'] }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="productname card-title">{{ $details['name'] }}</h5>
                        <p class="productprice card-text">Price: ₹{{ $details['price'] }}/-</p>
                        <div class="d-flex align-items-center mb-2 btn-group" role="group">
                            <button type="submit" data-id="{{ $id }}" class="decreaseQuantity btn btn-warning btn-sm me-1"
                                @if($details['quantity'] <= 1) disabled @endif>-</button>

                            <input type="text" class="cartQuantityInput form-control form-control-sm text-center btn-warning"
                                value="{{ $details['quantity'] }}" readonly style="width: 50px;">

                            <button type="submit" data-id="{{ $id }}"
                                class="increaseQuantity btn btn-warning btn-sm ms-1">+</button>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0"><i class="bi bi-currency-rupee"></i>
                                ₹{{ $details['price'] * $details['quantity'] }}/-</span>
                            <button type="submit" data-id="{{ $id }}" class="removeCard btn btn-danger btn-sm">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Your cart is empty.</p>
@endif

<div style="position: relative; min-height: 100%;">
    <div class="offcanvas-footer p-3 bg-light" style="position: absolute; bottom: 0; left: 0; width: 100%;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-secondary disabled">Qty:
                    {{ session('totalQuantity', 0) }}</button>
                <button type="button" class="btn btn-secondary disabled">Total:
                    ₹{{ session('totalPrice', 0) }}/-</button>
            </div>
            <a class="btn btn-warning">Place Order</a>
        </div>
    </div>
</div>