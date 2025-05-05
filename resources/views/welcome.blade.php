<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>

    {{-- Navigation Bar --}}
    <header class="bg-dark py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="#">My Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>

{{-- Categories Section --}}
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="mb-4 text-center">Browse Categories</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card border-0 shadow-sm h-100 text-center rounded-4 p-3 hover-shadow transition">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-tags-fill fs-4"></i> {{-- Optional: Use category icon if available --}}
                                </div>
                            </div>
                            <h5 class="card-title mb-1">{{ $category->name }}</h5>
                            <p class="text-muted small mb-0">{{ $category->posts->count() }} posts</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


    {{-- Posts Section --}}
    <section class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $post->featured_image ?? asset('images/default-thumbnail.jpg') }}"
                                 class="card-img-top" height="225" alt="Post image">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('posts.show', $post->id) }}">
                                        Read More &raquo;
                                    </a>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-muted py-5 bg-light">
        <div class="container">
            <p class="float-end mb-1"><a href="#">Back to top</a></p>
            <p class="mb-1">© {{ date('Y') }} My Blog</p>
            <p class="mb-0">Built with <a href="https://getbootstrap.com/">Bootstrap</a>.</p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>
