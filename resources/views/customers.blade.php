@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">S/N</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Created At</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($customers as $key=>$row)
		    <tr>
		      <th scope="row">{{++$key}}</th>
		      <td>{{ $row->name or null }}</td>
		      <td>{{ $row->email or null }}</td>
		      <td>{{ $row->created_at or null }}</td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
</div>
@endsection
