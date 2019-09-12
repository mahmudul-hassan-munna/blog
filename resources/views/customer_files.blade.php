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
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($customer_files as $key=>$row)
		    <tr>
		      <th scope="row">{{++$key}}</th>
		      <td><a href="{{ $row->path }}" target="_blank">View File</a></td>

		      <td>{{ $row->created_at or null }}</td>
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
	        <div class="form-group">
	        	<input type="file" name="file" class="form-control">
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

@endsection
