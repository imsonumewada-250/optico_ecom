@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        padding: 60px 0;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    /* Product Card */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* Category Buttons */
    .category-btn {
        margin: 0 5px;
    }
</style>

<div class="container mt-4">
    <!-- Hero Banner -->
    <div class="hero">
        <h2>Welcome, {{ Auth::user()->name ?? 'Guest' }} 👋</h2>
        <p>Discover amazing products at unbeatable prices!</p>
        <a href="#products" class="btn btn-light btn-lg mt-3">Shop Now</a>
    </div>

    <!-- Category Filter (Dummy for Now) -->
    <div class="text-center mb-4">
        <button class="btn btn-outline-primary category-btn">All</button>
        <button class="btn btn-outline-secondary category-btn">Electronics</button>
        <button class="btn btn-outline-success category-btn">Clothing</button>
        <button class="btn btn-outline-danger category-btn">Accessories</button>
    </div>

    <!-- Product Section -->
    <div id="products" class="row">
        @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card border-0 shadow-sm">
                        <img src="{{ asset('storage/products/'.$product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="product-img">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($product->description, 50) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">₹{{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-cart"></i> Add
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center text-muted">
                <p>No products available right now!</p>
            </div>
        @endif
    </div>
</div>
@endsection
