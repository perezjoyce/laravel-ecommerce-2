@extends('layouts.app')

@section('title', "Edit Item")

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
			<h1 class='text-center mb-4'>Edit {{ ucwords($item->name)}}</h1>

			<form action='/menu/{{ $item->id }}/edit_item' method='POST' enctype='multipart/form-data'>
            {{ csrf_field() }} 
            {{ method_field('PATCH') }}

				<div class="form-group">
					<label for="name">Name</label>
						<input type="text" class="form-control rounded-0" id="name" name='name' value="{{ $item->name }}">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea type="text" class="form-control rounded-0" id="description" name='description'>{{ $item->description }}
						</textarea>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" class="form-control rounded-0" id="price" name='price' min="1" value="{{ $item->price }}">
					</div>

					<div class="form-group">
						<label for="category">Categories</label>
						<select name="category" id="category" class="form-control rounded-0">
                            @foreach($categories as $category)
                                @if($category->id != $item->category_id)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @else
                                    <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                                @endif
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="image">Upload Image</label>
						<input type="file" class="form-control-file p-2 border rounded-0" id="image" name='image'>
					</div>

					<button class='btn btn-block btn-primary rounded-0' id='btn_add_item'>Save Changes</button>
			</form>
		</div>
	</div>
</div>


@endsection