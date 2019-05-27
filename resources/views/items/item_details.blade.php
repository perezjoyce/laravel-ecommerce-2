@extends('layouts.app')

@section('title', "Catalog")

@section('content')

    {{-- {{ dd($item) }} --}}
    
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
        <div class='row my-5 p-5'>
            <div class="col col-lg-4"></div>
            <div class='col'>
                <div class='d-flex flex-row'>
                <div><img src="{{$item->image_path}}"></div>
                <div class='d-flex flex-column ml-4'>
                    <h1 class="font-weight-bold">{{ $item->name }} </h1>
                    <p>{{ $category }}</p>
                    <h3 class='mb-4'><span>₱</span>{{ $item->price }} </h3>
                    <div class='mb-5'>{{ $item->description }} </div>
            
                    <div class='d-flex flex-row'>
                        <a href='/menu/{{$item->id}}/edit_form' class='btn btn-primary rounded-0 mr-2'>Edit</a>
                        <a href='#' class='btn btn-danger rounded-0' 
                                onclick="openDeleteModal({{ $item->id}}, '{{ $item->name }}')" data-toggle='modal'>DELETE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    

    <!-- MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete this item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <form method="POST" action="/menu/{{$item->id}}/delete_item" id='deleteItem'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="modal-body">
                            <span id='itemDel'>Do you want to delete {{$item->name}}?</span>			  
                        </div>
                    <div class="modal-footer">
                    <button type='submit' class='btn btn-danger'>Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</div>

    <!-- JS -->
    <script type="text/javascript">
        function openDeleteModal(id,name){
            $('#itemDel').html("Do you want to delete " + name + "?");
            $('#deleteModal').modal('show');
        }
    </script>



@endsection