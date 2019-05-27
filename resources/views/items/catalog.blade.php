@extends('layouts.app')

@section('title', "Catalog")

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col">
				<a href="#" class="btn btn-primary rounded-0">All</a>
				@foreach(\App\Category::all() as $category)
					<a href="/menu/categories/{{$category->id}}" class="btn btn-primary rounded-0">{{ $category->name }}</a>
				@endforeach
				<a href="/menu/add" class="btn btn-success rounded-0 float-right"> Add New Item </a>
				<hr>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				@if(Session::has("success_message"))
					<div class="alert alert-success">{{ ucfirst(Session::get("success_message")) }}</div>
				@elseif(Session::has("delete_message"))
					<div class="alert alert-danger">{{ ucfirst(Session::get("delete_message")) }}</div>
				@elseif(Session::has("error_message"))
					<div class="alert alert-danger">{{ ucfirst(Session::get("error_message")) }}</div>
				@else
					<div class="py-4"></div>
				@endif
			</div>
		</div>
		
		<div class="row">
			@foreach($items as $indiv_item)
				<div class="col-sm-4 mb-4">
					<div class="card">
						<img src="{{$indiv_item->image_path}}" class="card-img-top">
						<div class="card-body">
							<h5 class="card-title">{{ $indiv_item->name }}</h5>
							<p>{{ $indiv_item->description }}</p>
							<p>&#8369; {{ $indiv_item->price }}</p>
							<form method="POST" action="/add_to_cart/{{ $indiv_item->id }}">
								{{ csrf_field() }}
								<div class="form-group">
								<input type="number" name="quantity" class="form-control rounded-0 text-center" min="1" placeholder="Quantity">
								<button class="btn btn-block btn-outline-success rounded-0" type="submit"> Add To Cart </button>
								</div>
							</form>

							<a href="/menu/{{ $indiv_item->id }}" class="btn btn-block btn-primary rounded-0">View Details</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<!-- FOR DEVELOPER'S VIEW ONLY -->
		<div class="row">
			<div class="col">
				<form method="POST" action="/menu/clear_cart">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
					<a href='/menu/clear_cart' class='btn btn-lg border-danger text-danger rounded-0 float-right'>
						<i class="fas fa-angle-double-left"></i>
						Clear Cart
					</a>
				</form>
				
			</div>
		</div>
	</div>
		

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <!-- <script>
  	
		function addToCart(id) {
			let quantity = $("#quantity_"+id).val();
			// console.log("Item ordered: " + id + "Quantity Ordered: " + quantity);

			$.ajax({
				"url": "/addToCart/"+id,
				"type": "POST",
				"data": {
					'_token': "{{ csrf_token() }}",
					'quantity': quantity
				},
				"success": function(data) {
					alert("Current number of items in the cart is: " + data);
				}
			});
		}


  </script> -->



@endsection
