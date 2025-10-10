@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Link to external CSS files -->
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/brands.css') }}">
<link rel="stylesheet" href="{{ asset('css/deals.css') }}">
<link rel="stylesheet" href="{{ asset('css/deals-row.css') }}">

<div class="container mt-4">

    <!-- 🏆 FEATURED CAROUSEL -->
    <div class="custom-carousel">
        <div class="carousel-track">
            <img src="{{ asset('images/boxnew02.jpg') }}" alt="Banner 1" class="carousel-img">
            <img src="{{ asset('images/boxnew01.jpg') }}" alt="Banner 2" class="carousel-img">
            <img src="{{ asset('images/boxnew03.jpg') }}" alt="Banner 3" class="carousel-img">
        </div>

        <button class="carousel-btn prev">&#10094;</button>
        <button class="carousel-btn next">&#10095;</button>
    </div>

    <!-- ✨ CATEGORY FILTER -->
    <div class="container mx-auto py-10">
        <h1 class="category-header">Explore Our Collections</h1>

        <div class="category-filters">
            <a href="#"
               data-category=""
               class="category-btn {{ !$categorySlug ? 'active' : 'inactive' }}">
                All
            </a>

            @foreach ($categories as $cat)
                <a href="#"
                   data-category="{{ $cat->slug }}"
                   class="category-btn {{ $categorySlug == $cat->slug ? 'active' : 'inactive' }}">
                    {{ ucfirst($cat->name) }}
                </a>
            @endforeach
        </div>

        <!-- 🛍️ PRODUCT GRID -->
        <div class="product-grid" id="productGrid">
            @forelse ($products as $product)
                <div class="product-card" data-category="{{ $product->category->slug }}">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-image">
                        <div class="wishlist-btn">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>

                    <div class="product-content">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-category">{{ $product->category->name }}</p>
                        <div class="product-footer">
                            <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
                            <button class="view-btn">View</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-products">No products found.</p>
            @endforelse
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading-spinner" style="display: none;">
            <div class="spinner"></div>
        </div>
    </div>

</div>

<!-- 🎬 JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    let index = 0;
    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.carousel-img');
    const total = slides.length;

    function nextSlide() {
        index = (index + 1) % total;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    function prevSlide() {
        index = (index - 1 + total) % total;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    document.querySelector('.next').addEventListener('click', nextSlide);
    document.querySelector('.prev').addEventListener('click', prevSlide);
    let autoSlide = setInterval(nextSlide, 3000);
    track.addEventListener('mouseenter', () => clearInterval(autoSlide));
    track.addEventListener('mouseleave', () => { autoSlide = setInterval(nextSlide, 3000); });
});
</script>

<!-- 🛍️ Deals Section -->
<section class="deals-wrapper py-5">
  <div class="container-fluid">
    <div class="row g-3 align-items-start">

      <!-- 🧩 Left 3 Columns -->
      <div class="col-md-9">
        <div class="row g-3">
          @for ($i = 1; $i <= 3; $i++)
          <div class="col-md-4">
            <div class="deals-box">
              <div class="deals-header">
                <h5>Top Picks of the Sale</h5>
                <button class="arrow-btn">›</button>
              </div>
              <div class="deals-grid">
                <div class="deal-card"><img src="{{ asset('images/deals/img01.webp') }}" alt=""><p>Product A</p><span>Min. 50% Off</span></div>
                <div class="deal-card"><img src="{{ asset('images/deals/img02.webp') }}" alt=""><p>Product B</p><span>Min. 50% Off</span></div>
                <div class="deal-card"><img src="{{ asset('images/deals/img03.webp') }}" alt=""><p>Product C</p><span>Explore Now</span></div>
                <div class="deal-card"><img src="{{ asset('images/deals/img05.webp') }}" alt=""><p>Product D</p><span>Min. 50% Off</span></div>
              </div>
            </div>
          </div>
          @endfor
        </div>

        <!-- 🖼️ Image Below Products (Left Side) -->
        <div class="below-products-img mt-4">
          <!-- You will place your image here -->
          <img src="{{ asset('images/deals/lasthope.png') }}" alt="Promotional Image" class="below-left-img">
        </div>

        <!-- 💬 Quote -->
        <div class="quote-box mt-4">
          <h2 class="shopping-quote">
            <span class="highlight">Add a little joy</span> to your cart —
            <span class="tagline">happiness is just a click away.</span>
          </h2>
        </div>
      </div>

      <!-- 📸 Right Banner -->
      <div class="col-md-3">
        <div class="fashion-banner">
          <img src="{{ asset('images/deals/righttopimg.webp') }}" alt="Fashion Banner">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 🛋️ Furniture Deals -->
<section class="deals-row-section">
  <div class="container-fluid">
    <div class="section-header">
      <h4>Furniture Deals</h4>
      <button class="arrow-btn">›</button>
    </div>
    <div class="deals-row">
      <div class="deal-item"><img src="{{ asset('images/deals/.fur06webp.webp') }}" alt=""><p>Office Study Chairs</p><span>From ₹1,890</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/fur02.webp') }}" alt=""><p>TV Units</p><span>From ₹1,249</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/fur03.webp') }}" alt=""><p>Sofa Beds</p><span>From ₹6,099</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/fur04.webp') }}" alt=""><p>Sofa Set</p><span>From ₹21,999</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/fur05.webp') }}" alt=""><p>Beds</p><span>From ₹1,790</span></div>
       <div class="deal-item"><img src="{{ asset('images/deals/fur01.webp') }}" alt=""><p>Beds</p><span>From ₹1,790</span></div>
    </div>
  </div>
</section>

<!-- ⚡ Top Deals on Appliances -->
<section class="deals-row-section">
  <div class="container-fluid">
    <div class="section-header">
      <h4>Top Deals on Appliances</h4>
      <button class="arrow-btn">›</button>
    </div>
    <div class="deals-row">
      <div class="deal-item"><img src="{{ asset('images/deals/elc01.webp') }}" alt=""><p>Fans & Geysers</p><span>From ₹799</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/elc02.webp') }}" alt=""><p>Best Selling Styles</p><span>Min. 40% Off</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/elc03.webp') }}" alt=""><p>Women's Shirts</p><span>Min. 70% Off</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/elc04.webp') }}" alt=""><p>Women Bra</p><span>From ₹99</span></div>
      <div class="deal-item"><img src="{{ asset('images/deals/elc05.webp') }}" alt=""><p>Puma, Adidas...</p><span>Min. 40% Off</span></div>
         <div class="deal-item"><img src="{{ asset('images/deals/elc07.webp') }}" alt=""><p>Puma, Adidas...</p><span>Min. 40% Off</span></div>
    </div>
  </div>
</section>
    <!-- 💬 TESTIMONIALS -->
    <section class="testimonials-section">
        <h4 class="testimonials-title">What Our Customers Say</h4>
        <div class="testimonials-grid">
            <div class="testimonial">
                <p>"Amazing quality and super fast delivery!"</p>
                <strong>- Priya Sharma</strong>
            </div>
            <div class="testimonial">
                <p>"Best e-commerce experience I've had so far."</p>
                <strong>- Rahul Mehta</strong>
            </div>
            <div class="testimonial">
                <p>"Customer support was extremely helpful."</p>
                <strong>- Neha Patel</strong>
            </div>
        </div>
    </section>

<!-- 🌍 Brand Showcase Section -->
<section class="brand-section">
  <div class="brand-container">
    <h2 class="section-title">Our Trusted Partners</h2>
    <p class="section-subtitle">We collaborate with globally recognized brands that redefine quality and innovation.</p>

    <div class="brand-grid">
      <div class="brand-card"><div class="logo-container"><img src="{{ asset('images/brands/logo01.jpg') }}" alt=""></div><h5>Toyota</h5></div>
      <div class="brand-card"><div class="logo-container"><img src="{{ asset('images/brands/logo02.png') }}" alt=""></div><h5>LG</h5></div>
      <div class="brand-card"><div class="logo-container"><img src="{{ asset('images/brands/croma.png') }}" alt=""></div><h5>Croma</h5></div>
      <div class="brand-card"><div class="logo-container"><img src="{{ asset('images/brands/logo06.jpg') }}" alt=""></div><h5>Prince Jewellery</h5></div>
    </div>
  </div>
</section>




@endsection
