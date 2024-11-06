<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __($title) }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #eaeaea;
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            background-color: #ffffff;
            padding: 20px;
            border-right: 1px solid #e5e5e5;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #000;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .active {
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .content {
            padding: 20px;
        }

        /* Card styling */
        .card {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            text-align: center;
            position: relative;
        }

        .icon {
            font-size: 40px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .lock-icon {
            font-size: 20px;
            color: #6c757d;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .card-title {
            font-size: 18px;
            margin-top: 10px;
            color: #000;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .sidebar {
                height: auto;
            }
        }
    </style>

    @stack('styles')
    @livewireStyles
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <!-- Main Content -->
            {!! $slot !!}

        </div>
    </div>

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    @livewireScripts

</body>

</html>
