@extends('layouts.app')

@section('title', "Order History")

@section('content')
	
	<div class="container">
		
		<div class="row">
			<div class='col-1'></div>
			<div class="col">
				@if(Session::has("success_message"))
					<div class="alert alert-success">{{ ucfirst(Session::get("
						
						
						")) }}</div>
				@elseif(Session::has("delete_message"))
					<div class="alert alert-danger status-box"> 
						<span>{{ Session::get("delete_message")}}</span>
						<a href="{{ Session::get('undo_url') }}" 
							class="btn btn-link">UNDO</a>
					</div>
				@elseif(Session::has("error_message"))
					<div class="alert alert-danger">{{ ucfirst(Session::get("error_message")) }}</div>
				@else
					<div class="py-4"></div>
				@endif
			</div>
			<div class='col-1'></div>
		</div>
		

        <div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
				<h3>Order History</h3>
			</div>
			<div class='col-1'></div>
		</div>

		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
		
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Order ID</th>
							<th scope="col">Client</th>
							<th scope="col">Date Purchased</th>
							<th scope="col">Total</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $order)
                            <tr>
								<td> {{ $order->id}} </td>
								<td> {{ ucwords($order->user->name) }}</td>
                                <td> {{ $order->created_at }} </td>
                                <td>
                                    ₱ {{ number_format($order->total, 2, '.', ',') }}
                                </td>
                                <td> 
									<div class="form-group">
										<select class="form-control" id="order_status{{$order->id}}" onchange="changeOrderStatus({{ $order->id }})">
											@foreach($statuses as $status)
												<option value="{{ $status->id }}" 
													{{ $order->status_id === $status->id ? "selected" : ""}}>
													{{ $status->status_name}}
												</option>
											@endforeach
										</select>
									</div>
								</td>
								<td>
									<a href="#" onclick="deleteOrder({{ $order->id }})">
										<i class="fas fa-trash alt fa-2x text-secondary"></i>
									</a>
								</td>
								
                            </tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class='col-1'></div>
        </div>
       

	</div>



	<div class="modal fade" id="delete_order_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-5">
					<h3 class="modal-title">Delete Order</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   		<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
					<span id="delete_order_question"></span>		
				</div>
				<div class="modal-footer p-5">
					<form method="post" id="delete_order_form">
							@csrf
							{{ method_field('DELETE') }}
							<button type='submit' class='btn btn-lg bg-dark text-light 
							rounded-0'>Confirm Deletion</button>
							<button type="button" class="btn btn-lg border rounded-0" 
							data-dismiss="modal">Close</button>
					</form>	
				</div>
        	</div>
        </div>
    </div>


	<div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="status_form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-5">
					<h3 class="modal-title">Update Order Status</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   		<span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-5">
					<span id="status_form_question"></span>		
				</div>
				<div class="modal-footer p-5">
					<form method="post" id="status_form">
						@csrf
						{{ method_field('PATCH') }}
						<input type="hidden" name="new_order_status" id="new_order_status">
						<button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>Yes, Please.</button>
                    	<button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
					</form>	
				</div>

        	</div>
        </div>
    </div>


	<script>

		function changeOrderStatus(orderid) {
			//pass new status id
			var status = document.getElementById('order_status' + orderid);
			document.getElementById('new_order_status').value = status.value;

			//pass status name
			var text = status.options[status.selectedIndex].text; 
			var question = document.getElementById('status_form_question');
			question.innerHTML = "Do you want to mark order #" + orderid + " as " + text + "?";

			//add action/route
			document.getElementById('status_form').setAttribute('action', '/change_order_status/' + orderid);

			//show modal
			$('#status_modal').modal('show');
		}

		function deleteOrder(orderid){
			var question = document.getElementById('delete_order_question');
			question.innerHTML = "Do you want to delete order #" + orderid + "?";

			document.getElementById('delete_order_form')
				.setAttribute('action', '/delete_order/' + orderid);

			$('#delete_order_modal').modal('show');
		}


	</script>

	
@endsection
