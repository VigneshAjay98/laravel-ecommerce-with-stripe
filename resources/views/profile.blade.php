@extends('layouts.app')


@section('title')
    TrickyMall
@endsection

@section('content')
	
	<div class="container">
		<div class="row justify-content-md-center">
	        <div class="col-md-12">
				<h2>My Orders</h2>
				<table class="table ">
				  <thead>
				    <tr>
				      <th>Name</th>
				      <th>Price</th>
				      <th>Quantity</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($orders as $order)
				    	@foreach($order->cart->items as $item)
					  	<tr>
					  		<td scope="row"> {{ $item['item']['name'] }} </td>
					  		<td> <img src="{{ asset('rupee-indian.png') }}" alt="inr" width="12" height="12">{{ $item['price'] }} </td>
					  		<td><span class="badge badge-dark"> {{ $item['qty'] }} </span></td>
					  	</tr>
					  	@endforeach
					@endforeach
				  </tbody>
				</table>

				<div class="row">
					<div class= "col-md-12">
						<strong>Total: <img src="{{ asset('rupee-indian.png') }}" alt="inr" width="13" height="13">{{ $order->cart->totalPrice }}</strong>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

