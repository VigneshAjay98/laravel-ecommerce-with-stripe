@extends('layouts.app')

@section('title')
    TrickyMall
@endsection

@section('content')
<div class="container text-center">
    <h2> Products </h2>
    <div class="row">
        @foreach ($allProducts as $product)
        <div class='col-4'>
            <div class="card">
                <img class="card-img-top" src="{{ asset('default.jpg') }}" alt="img">
                <div class="card-body">
                  <h4 class="card-title">{{ $product->name }}</h4>
                  <p class="card-text">{{ $product->description }}</p>
                 
                 <h3><img src="{{ asset('rupee-indian.png') }}" alt="inr" width="19" height="19">{{ $product->price }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="card-link"> Add to Cart </a>
                </div>  
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('footer')
<footer class="page-footer font-small special-color-dark pt-4">
  <!-- Footer Elements -->
  <div class="container">
    <!-- Social buttons -->
    <ul class="list-unstyled list-inline text-center">
      <li class="list-inline-item">
        <a class="btn-floating btn-fb mx-1">
          <i class="fab fa-facebook-f"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-tw mx-1">
          <i class="fab fa-twitter"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-gplus mx-1">
          <i class="fab fa-google-plus-g"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-li mx-1">
          <i class="fab fa-linkedin-in"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-dribbble mx-1">
          <i class="fab fa-dribbble"> </i>
        </a>
      </li>
    </ul>
  </div>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="{{ route('home') }}"> TrickyMall</a>
  </div>
</footer>
@endsection

