@extends('layouts.app')

@section('content')
<div class="container">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Add File
	</button>

	


    <div class="row">
        <table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">S/N</th>
		      <th scope="col">File</th>
		      <th scope="col">Created At</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($customer_files as $key=>$row)
		    <tr>
		      <th scope="row">{{++$key}}</th>
		      <td><img src="{{ asset($row->path) }}" width="60px" height="60px"></td>
		      <!-- <td></td> -->
		      <td>{{ $row->created_at or null }}</td>
		      <td>
		      		<?php $image_path=asset($row->path); ?>
		      		<a type="button" class="btn btn-warning btn-xs" href="{{ $row->path }}" target="_blank">View File</a>

		      		<button type="button" class="btn btn-primary btn-xs" onclick="popupImage('<?php echo $image_path?>')">Popup image</button>

		      		<form class="form-horizontal" method="POST" action="{{ url('delete-file') }}">
		      			{{ csrf_field() }}
		      			<input type="hidden" name="id" value="{{$row->id}}">
		            <button class="btn btn-danger btn-xs" type="submit" data-toggle="tooltip" title="Delete"
		                    onclick="return confirm('Are you sure to delete this entry?')"><i
		                        class="fa fa-trash" title="Delete">Delete</i>
		            </button>
		            </form>
		        </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal" method="POST" action="{{ url('save-file') }}"  enctype="multipart/form-data">
          {{ csrf_field() }}
	      <div class="modal-body">
	      	<div class="col-md-12">
	      		<div class="form-group">
		        	<input type="file" name="file" class="form-control">
		        </div>
		        <div class="form-group">
		        	<label>Image Width</label>
		        	<input type="number" name="width" class="form-control">
		        </div>
		        <div class="form-group">
		        	<label>Image Height</label>
		        	<input type="text" name="height" class="form-control">
		        </div>
	      	</div>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
	  </form>

    </div>
  </div>
</div>




<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <img src="" class="img-responsive" id="my_image">
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function popupImage(path)
	{
		$("#my_image").attr("src",path);
		$('#myModal').modal('show'); 

	}
</script>

@endsection
