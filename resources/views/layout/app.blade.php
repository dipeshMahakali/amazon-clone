<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #232f3e;
            /* Amazon's dark header color */
        }

        .location-selector {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: #232f3e;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            max-width: 200px;
            /* Adjust as needed */
        }

        .location-icon {
            margin-right: 5px;
            font-size: 16px;
            color: #f0c14b;
            /* Amazon's highlight yellow */
        }

        #locationText {
            flex-grow: 1;
            /* Allows text to take available space */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .change-location-button {
            background: none;
            border: none;
            color: #f0c14b;
            font-size: 14px;
            margin-left: 10px;
            cursor: pointer;
            padding: 0;
            text-decoration: underline;
        }

        .change-location-button:hover {
            color: #ff9900;
        }
    </style>
    <title>Product Management</title>
</head>

<body style="background: linear-gradient(to bottom right, #f1e0f6, #e5dff6);height: 100vh;">
    @include('layout.header')
    @yield('content')

    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>