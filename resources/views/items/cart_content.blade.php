@extends('layouts.app')

@section('title', "My Cart")

@section('content')
	
	<div class="container">
		
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
        
        @if(Session::has('cart'))
        <div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
				<h3>Cart Items</h3>
			</div>
			<div class='col-1'></div>
		</div>

		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
		
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col" width='25%'>Name</th>
							<th scope="col" width='25%'>Quantity</th>
							<th scope="col" width='25%'>Price</th>
							<th scope="col" width='25%'>Subtotal</th>
							<th scope="col" width='25%'>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach($item_cart as $item)
						<tr>
							<th scope="row">{{$item->name}}</th>
							<td> 
                                <form method="POST" id="update_quantity{{$item->id}}">
                                    {{ csrf_field() }}
	                                {{ method_field('PATCH') }}

                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text rounded-0" onclick="minus({{ $item->id }})">
                                                &#8722;
                                            </button>
                                        </div>
                                                
                                        <input type='number' class='rounded-0 text-center' name='quantity' id="quantity{{$item->id}}" value='{{ $item->quantity }}' style='width:25%;' min='1'>	

                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text rounded-0" onclick="plus({{ $item->id }})">
                                            +
                                            </button>
                                        </div>
                                    </div>
                                </form>
							</td>
							<td>
                                ₱ {{ number_format($item->price, 2, '.', ',') }}
                            </td>
							<td>
                                ₱ {{ number_format($item->subtotal, 2, '.', ',') }}
                            </td>
							<td>
								<a class='btn border rounded-0' onclick="openDeleteItemModal({{ $item->id}}, '{{ $item->name }}')" data-toggle='modal' data-target="#delete_cart_item_modal">Delete</a>
							</td>
						</tr>
						@endforeach

						<tr>
							<td colspan='3' class='font-weight-bold text-right'>TOTAL</th>
							<td colspan='2'>₱ {{ number_format($total, 2, '.', ',') }}</td>
                        </tr>			
					</tbody>
				</table>
			</div>
		</div>

		
		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col-9 d-flex flex-row'>
				<a href='/catalog' class='btn btn-lg btn-outline-primary rounded-0 mr-2'>
					<i class="fas fa-angle-double-left"></i>
					Continue Shopping
                </a>
         
                <button onclick="pay()" class="btn btn-primary rounded-0">Checkout</button>
                
			</div>
			<div class='col'>
                <a href='/menu/clear_cart' class='btn btn-lg border-danger text-danger rounded-0 float-right' data-toggle="modal" data-target="#delete_cart_modal">
					<i class="fas fa-angle-double-left"></i>
					Clear Cart
				</a>
            </div>
            <div class="col"></div>
		</div>

        @else
            <div class="row">
                <div class="col d-flex flex-column">
                    <h1 class="text-center mb-5">Your cart is empty. :(</h1>
                    <a href='/catalog' class='btn btn-lg border-primary rounded-0'>
                        <i class="fas fa-angle-double-left"></i>
                        Go Back To Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="delete_cart_modal" tabindex="-1" role="dialog" aria-labelledby="delete_cart_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-5">
                    <h3 class="modal-title">Delete This Cart</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <span>Do you want to delete all items in this cart?</span>			  
                </div>
                <div class="modal-footer p-5">
                <form method="POST" action="/menu/clear_cart">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                    <button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>Clear Cart</button>
                    <button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
                </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_cart_item_modal" tabindex="-1" role="dialog" aria-labelledby="delete_cart_item" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-5">
                    <h3 class="modal-title" id="delete_cart_item_title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-5" id="delete_cart_item_question">		  
                </div>
                <div class="modal-footer p-5">
                <form method="POST" id="delete_cart_item_form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                    <button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>Delete Item</button>
                    <button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
                </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="error_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-5">
                    <h3 class="modal-title">Oops!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    There's something wrong with our server. Please try again later. :(		  
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPT -->
    @if(Session::has('cart'))
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_rWDY8edh1HwiHpUob84DPmgW00gIhpA9vM');
        stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as parameter here
            // instead of 
            sessionId: '{{$CHECKOUT_SESSION_ID}}'
            }).then((result) => {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
            $("#error_modal").modal('show');  
        });
        
    </script>
    @endif
    <script>
        function openDeleteItemModal(id, name) {
            $('#delete_cart_item_title').html("Delete " + name + "?");
            $('#delete_cart_item_question').html("Are you sure about deleting " + name + " from your cart?");
            $('#delete_cart_item_form').attr('action', '/menu/mycart/' + id + '/delete_cart_item');
            $('#delete_cart_item_modal').submit();
        }
        function minus(id){
            $value = $("#quantity"+id).val();
            $value = parseInt($value);
            if($value > 1){
                $("#quantity"+id).val($value-1);
            }
            $('#update_quantity'+id).attr('action', '/menu/mycart/' + id + '/change_quantity');
            $('#update_quantity'+id).submit();
	    }
        function plus(id){
            $value = $("#quantity"+id).val();
            $value = parseInt($value);
            $("#quantity"+id).val($value+1);
            $('#update_quantity'+id).attr('action', '/menu/mycart/' + id + '/change_quantity');
            $('#update_quantity'+id).submit();
        }
    </script>

@endsection
