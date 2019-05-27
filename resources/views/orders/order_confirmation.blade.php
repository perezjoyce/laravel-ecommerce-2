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

        <div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
                <h2 class="my-5">Thank you for shopping with us!</h2>
                <p>Your payment will be verified within the day. Proceed to <a href="/orders">order page</a> to view the status of your order.</p>
			</div>
			<div class='col-1'></div>
		</div>
    </div>
@endsection