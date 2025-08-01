<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="https://dcassetcdn.com/design_img/3628856/741339/741339_20097970_3628856_72039e4c_image.png"
                alt="Logo" width="40" height="40" class="me-2" style="border-radius: 8px;">
            <strong>SM Mall</strong>
        </a>

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <div id="locationDisplay" class="location-selector text-white">
                <i class="fas fa-map-marker-alt location-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path
                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg></i>
                <span id="locationText">{{ session('user_location') }}</span>
                {{-- <button id="changeLocationBtn" class="change-location-button">Change</button> --}}
            </div>
            <!-- Centered Search Bar -->
            <form class="d-flex position-relative mx-auto" style="width: 50%;">
                <div class="w-100 position-relative">
                    <input class="form-control me-2" type="search" id="searchProduct" placeholder="Search products..."
                        aria-label="Search" autocomplete="off">

                    <!-- Dropdown suggestions -->
                    <div id="searchDropdown" class="list-group position-absolute w-100"
                        style="top: 100%; z-index: 1050; display: none;">
                    </div>
                </div>

                {{-- <button class="btn btn-warning text-dark ms-2" type="submit">Search</button> --}}
            </form>

            <!-- Right Side Icons -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex flex-row align-items-center">
                <li class="nav-item">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cart" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <strong><sup class="cart-count text-warning">0</sup></strong>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" data-bs-scroll="true"
                        data-bs-backdrop="false" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Cart Products</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            {{-- @include('partials.cart-offcanvas') --}}
                        </div>
                    </div>
                </li>
            </ul>
        </div>&nbsp;&nbsp;
        <div class='nav-item btn-group' id='logout'>
            <button type="button" class="btn btn-secondary  ">Action</button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="/logout" class="btn btn-secondary">logout</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>

        </div>
    </div>
</nav>