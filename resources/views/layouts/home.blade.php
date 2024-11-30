<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if (config('app.locale') != 'en') dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ __('Future Echo') }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: "Cairo", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <header class="bg-dark text-white text-center py-5">
        <div class="container">
            <h1>{{ __('Preserve Your Memories for the Future') }}</h1>
            <p class="lead">{{ __('Store your memories securely, set timelines, and remind your loved ones.') }}</p>
            <div>
                <a href="{{ route('v1.registration') }}" class="btn btn-primary btn-lg"> {{ __('Get Started') }} </a>
                <a href="#how-it-works" class="btn btn-outline-light btn-lg"> {{ __('Learn More') }} </a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4"> {{ __('Features') }} </h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Memory Storage') }}</h5>
                            <p class="card-text">{{ __('Securely store your precious memories.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Timeline Management') }}</h5>
                            <p class="card-text">{{ __('Organize your memories with timelines.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Notifications') }}</h5>
                            <p class="card-text">{{ __('Send reminders to contributors.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Capsule System') }}</h5>
                            <p class="card-text">{{ __('Securely deliver memories at the right time.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="mb-4">{{ __('How It Works') }}</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>{{ __('Step 1') }}</h5>
                            <p>{{ __('Create an account.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>{{ __('Step 2') }}</h5>
                            <p>{{ __('Add memories and contributors.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>{{ __('Step 3') }}</h5>
                            <p>{{ __('Securly encrypted added memories.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>{{ __('Step 4') }}</h5>
                            <p>{{ __('Set a timeline.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-2">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>{{ __('Step 5') }}</h5>
                            <p>{{ __('Share and get reminders.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">{{ __('What Our Users Say') }}</h2>
            <div class="row">
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>{{ __('"Future Echo helped me save my best memories."') }}</p>
                        <footer class="blockquote-footer">{{ __('John Doe') }}</footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>{{ __('"A truly innovative system for preserving memories."') }}</p>
                        <footer class="blockquote-footer">{{ __('Jane Smith') }}</footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>{{ __('"The perfect tool for sending future messages!"') }}</p>
                        <footer class="blockquote-footer">{{ __('Ahmed Khalil') }}</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>{{ now()->year }} &copy; {{ __('Future Echo. All Rights Reserved.') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
