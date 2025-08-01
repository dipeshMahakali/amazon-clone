@extends('layout.app')
@section('content')
    {{-- <div id="locationDisplay"></div> --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="storage/images/ba5309c6-39fa-4f0f-9c62-de5d63d00b3b.jpg" class="d-block w-100" height="700px"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="storage/images/10247135.jpg" class="d-block w-100" height="700px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="storage/images/10150011.jpg" class="d-block w-100" height="700px" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container bg-light  rounded-3 mt-2 mb-2">
        <div class="form-control w-100 mt-2 d-flex flex-row-reverse justify-content-between align-items-right">
            <select class="form-control mt-2 w-25">
                <option value="0">Select Category</option>
                @foreach ($category as $catgory)
                    <option value="{{$catgory->id}}">{{$catgory->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="row mt-2 mb-2" id="product-list" style="height: 600px; overflow-y: auto;">
            <!-- Products will be loaded here via AJAX -->
        </div>
    </div>
    <!-- Location Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Select Your Location</h5>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="locationSelect">
                        <option value="">-- Select Location --</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->name }}">{{ ucfirst($loc->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button id="submitLocationBtn" class="btn btn-primary" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var productsInfo = @json($products->keyBy('id'));
    console.log(productsInfo);

    let currentPage = 1;
    let loading = false;
    let hasMore = true;
    let selectedCategoryId = null;

    function loadProducts(page, categoryId = null) {
        if (loading || !hasMore) return;
        loading = true;

        let url = `/products?page=${page}`;
        if (categoryId) {
            url += `&category_id=${categoryId}`;
        }

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                let products = response.data || response;
                if (!products.length) {
                    hasMore = false;
                    return;
                }

                let html = '';
                products.forEach(function (product) {
                    html += `
                    <div class="col-md-3 mb-2 d-flex justify-content-center ">
                        <div class="card shadow-sm w-100 h-100 " style="max-width: 300px;">
                            <img src="storage/${product.image_link}" class="card-img-top img-fluid rounded-start"
                                alt="${product.name}" style="height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.description}</p>
                                <div class="d-flex flex-row-reverse justify-content-between align-items-center">
                                    <span class="h5 mb-0">Price: ₹${product.adjusted_price}/-</span>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-row-reverse justify-content-between align-items-center bg-light">
                                <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="id" value="${product.id}">
                                    <input type="hidden" name="categoryId" value="${product.category_id}">
                                    <input type="hidden" name="productname" value="${product.name}">
                                    <input type="hidden" name="productdescription" value="${product.description}">
                                    <input type="hidden" name="productprice" value="${product.adjusted_price}">
                                    <input type="hidden" name="productimage" value="${product.image_link}">
                                    <button class="btn btn-warning btn-sm" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                });

                $('#product-list').append(html);
                loading = false;

                if (!response.next_page_url) hasMore = false;

                const $container = $('#product-list');
                if ($container[0].scrollHeight <= $container.innerHeight() && hasMore) {
                    currentPage++;
                    loadProducts(currentPage, selectedCategoryId);
                }
            },
            error: function () {
                loading = false;
            }
        });
    }

    // Initial load
    $(document).ready(function () {
        // Loader element
        const loaderHtml = `<div id="product-loader" class="text-center my-3"><div class="spinner-border text-warning" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
        $('#product-list').before(loaderHtml);
        $('#product-loader').show();

        loadProducts(currentPage, selectedCategoryId);

        $('#product-list').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 50) {
                if (!loading && hasMore) {
                    $('#product-loader').show();
                    currentPage++;
                    loadProducts(currentPage, selectedCategoryId);
                }
            }
        });
        let searchRequest;

        $('#searchProduct').on('keyup', function () {
            const query = $(this).val().trim();

            if (query.length < 2) {
                $('#searchDropdown').hide().html('');
                return;
            }

            // Cancel previous AJAX request if still pending
            if (searchRequest) {
                searchRequest.abort();
            }

            searchRequest = $.ajax({
                url: '{{ route("product.search") }}',
                type: 'GET',
                data: { q: query },
                success: function (data) {
                    let html = '';
                    if (data.length === 0) {
                        html = `<div class="list-group-item text-muted">No products found</div>`;
                    } else {
                        data.forEach(function (product) {
                            html += `
                                <a href="/products/${product.id}" class="list-group-item list-group-item-action">
                                    ${product.name} - ₹${product.adjusted_price}
                                </a>
                            `;
                        });
                    }

                    $('#searchDropdown').html(html).show();
                },
                error: function () {
                    $('#searchDropdown').hide();
                }
            });
        });

        // Optional: hide dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#searchProduct, #searchDropdown').length) {
                $('#searchDropdown').hide();
            }
        });
        $('select').on('change', function () {
            selectedCategoryId = $(this).val() || null;
            currentPage = 1;
            hasMore = true;
            $('#product-list').html(''); // Clear existing
            loadProducts(currentPage, selectedCategoryId);
        });

        // Hide loader when products loaded
        $(document).ajaxStop(function () {
            $('#product-loader').hide();
        });
        $('#logout').hide();

        const userLocation = "{{ session('user_location') }}";
        if (!userLocation) {
            const locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
            locationModal.show();

            $('#locationSelect').on('change', function () {
                $('#submitLocationBtn').prop('disabled', $(this).val() === '');
            });

            $('#submitLocationBtn').on('click', function () {
                const location = $('#locationSelect').val();
                $.post('{{ route('set.location') }}', { location }, function (res) {
                    locationModal.hide();

                    // location.reload(); // reload page to apply price
                }).fail(function (err) {
                    alert('Failed to set location');
                });
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        loadcart();
        function loadcart() {
            $.ajax({
                url: '/showcart',
                type: 'GET',
                success: function (result) {
                    // Group items by product_id and calculate quantity
                    // console.log(result);
                    let grouped = {};
                    let totalQuantity = 0;
                    let totalAmount = 0;

                    for (let i = 0; i < result.length; i++) {
                        let item = result[i];
                        if (!grouped[item.product_id]) {
                            grouped[item.product_id] = {
                                product_id: item.product_id,
                                price: item.price,
                                quantity: 1
                            };
                        } else {
                            grouped[item.product_id].quantity += 1;
                        }
                        totalAmount += item.price;
                    }
                    // console.log(grouped);
                    let html = '';
                    for (let key in grouped) {
                        let item = grouped[key];
                        item.totalPrice = item.price * item.quantity;
                        totalQuantity += item.quantity;
                        // totalAmount += item.totalPrice;

                        // Get product details from productsInfo
                        let details = productsInfo[item.product_id] || {};
                        html += `
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="storage/${details.image_link || ''}" class="productimage img-fluid object-fit-cover rounded-start" alt="" style="object-position: top;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="productname card-title">${details.name || 'Product'}</h5>
                                        <p class="productprice card-text">Price: ₹${item.price} x ${item.quantity}</p>
                                        <p class="cartTotalPrice card-text">Total: ₹${item.totalPrice}/-</p>
                                        <div class="d-flex align-items-center mb-2 btn-group" role="group">
                                            <button type="button" data-id="${item.product_id}" class="decreaseQuantity btn btn-warning btn-sm me-1">-</button>
                                            <input type="text" class="cartQuantityInput form-control form-control-sm text-center btn-warning" value="${item.quantity}" readonly style="width: 50px;">
                                            <button type="button" data-id="${item.product_id}" class="increaseQuantity btn btn-warning btn-sm ms-1">+</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    }
                    // Add footer
                    html += `
                    <div class="offcanvas-footer p-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <span><strong>Total Quantity:</strong> ${totalQuantity}</span>
                            <span><strong>Total Amount:</strong> ₹${totalAmount}/-</span>
                        </div>
                        <button class="btn btn-success w-100" id="placeOrderBtn">Place Order</button>
                    </div>
                `;
                    $('.offcanvas-body').html(html);
                    $('.cart-count').text(totalQuantity);
                }
            });
        }
        $(document).on('click', '.increaseQuantity', function () {
            let productId = $(this).data('id');
            $.ajax({
                url: '/cart/increase/' + productId,  // Adjust to your route
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF for Laravel
                },
                success: function () {
                    // Refresh cart
                    // console.log('increase button clicked.', productId);
                    loadcart(); // your function that calls `/showcart` AJAX
                }
            });
        });
        $(document).on('click', '.decreaseQuantity', function () {
            let productId = $(this).data('id');
            $.ajax({
                url: '/cart/decrease/' + productId,
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    // console.log('decrease button clicked.');
                    loadcart();
                }
            });
        });
        $(document).on('click', '.removeCard', function () {
            let productId = $(this).data('id');
            $.ajax({
                url: '/cart/remove',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    console.log();
                    loadcart();
                }
            });
        });

    });


</script>
