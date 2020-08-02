@extends('layouts.app')

@section('title')
    TrickyMall
@endsection

@section('content')
	@if(Session::has('success'))
		<div class="container">
			<div class="row justify-content-md-center">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="charge-message" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
		</div>
        @endif
	@if(Session::has('cart'))
	<div class= "container">
		<table class="table ">
		  <thead>
		    <tr>
		      <th>Name</th>
		      <th>Price</th>
		      <th>Quantity</th>
		      <th>Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    	@foreach($products as $product)
			  	<tr>
			  		<td scope="row"> {{ $product['item']['name'] }} </td>
			  		<td> <img src="{{ asset('rupee-indian.png') }}" alt="inr" width="12" height="12">{{ $product['price'] }} </td>
			  		<td><span class="badge badge-dark"> {{ $product['qty'] }} </span></td>
			  		<td>
			  			<a href="{{ route('reduce', [ 'id' => $product['item']['id'] ]) }}"><img src="{{ asset('minus.png') }}" alt="minus" width="18" height="18"></a>&nbsp&nbsp|&nbsp&nbsp
			  			<a href="{{ route('drop', [ 'id' => $product['item']['id'] ]) }}"><img src="{{ asset('trash.png') }}" alt="trash" width="18" height="18"></a>
			  		</td>
			  	</tr>
			  	@endforeach
		  </tbody>
		</table>

		<div class="row">
			<div class= "col-md-12">
				<strong>Total: <img src="{{ asset('rupee-indian.png') }}" alt="inr" width="13" height="13">{{ $totalPrice }}</strong>
			</div>
		</div>

		<div class="row">
			<div class= "col-md-12">
				<a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
			</div>
		</div>
	</div>	
	@else
		<div class="container">
			<div class="row justify-content-md-center">
				<div class= "col-sm-8 ">
					<h2>No Items are in your Cart</h2>
					<a href="{{ route('home') }}" type="button" class="btn btn-secondary">Continue Shopping</a>
				</div>
			</div>
		</div>
	@endif
@endsection


