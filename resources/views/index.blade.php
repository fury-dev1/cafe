@extends('layouts.master')

@section('title', 'Главная')

@section('content')
<!-- Background image -->
<div class="container mt-2">
    <div
        class="p-5 text-center bg-image"
        style="
      background-image: url('https://images.pexels.com/photos/1695052/pexels-photo-1695052.jpeg?cs=srgb&dl=pexels-igor-haritanovich-1695052.jpg&fm=jpg');
      height: 300px;
    "
    >
        <div class="mask" style="background-color: rgba(0,0,0,0.31)">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h2 class="mb-3">Теперь мы <strong>online!</strong></h2>
                    <h4 class="mb-3">Заказывай на сайте - забирай в кафе без <strong>очереди!</strong></h4>
                    <!-- <a class="btn btn-outline-light btn-lg" href="#!" role="button"
                      >Call to action</a
                    > -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Background image -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarCenteredExample2"
            aria-controls="navbarCenteredExample2"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div
            class="collapse navbar-collapse justify-content-center"
            id="navbarCenteredExample2"
        >
            <!-- Left links -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">ВСЕ КАТЕГОРИИ</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{ route('category', $category->code) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!-- Products -->
<section class="text-center mt-3">
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                @include('layouts.card', compact('product'))
            @endforeach
        </div>
    </div>
</section>
<!-- Products -->

<!-- Pagination -->
<div class="container">
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </nav>
</div>
<!-- Pagination -->
@endsection
