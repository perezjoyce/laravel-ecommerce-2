@extends('layouts.app')

@section('title', "Add Item")

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
    <div class="row">
		<div class="col col-lg-4"></div>
		<div class='col col-lg-4 d-flex flex-column'>
			<h1 class='text-center mb-4'>Add New Item</h1>

			<form action='/menu/add_item' method='POST' enctype='multipart/form-data'>
			{{ csrf_field() }} 

				<div class="form-group">
					<label for="name">Name</label>
						<input type="text" class="form-control rounded-0" id="name" name='name'>
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea type="text" class="form-control rounded-0" id="description" name='description'>
						</textarea>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" class="form-control rounded-0" id="price" name='price'>
					</div>

					<div class="form-group">
						<label for="category">Categories</label>
						<select name="category" id="category" class="form-control rounded-0">
							@foreach($categories as $category)
								<option value="{{ $category->id }}"> {{ $category->name }} </option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="image">Upload Image</label>
						<input type="file" class="form-control-file p-2 border rounded-0" id="image" name='image'>
					</div>

					<button class='btn btn-block btn-primary rounded-0' id='btn_add_item'>+ Add New Item</button>
			</form>
		</div>
	</div>
</div>


@endsection