@extends('layouts.app')

@section('content')

<div class="container padding-top-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Please specify your request:</h3>
		</div>
		<div class="panel-body">
			<form class="form-group" method="post" enctype="multipart/form-data" action="{{ url('/special-post') }}">
				<label for="name">Item Name: </label>
				<input class="form-control" type="text" name="name"><br>
				<label for="image">Upload Image: </label>
				<input class="form-control" type="file" name="image">
				<label for="description">Description: </label>
				<textarea class="form-control" name="description" id="description"></textarea><br>
				<input type="submit" name="Submit">
				<input type="hidden" value="{{ Session::token() }}" name="_token" />
			</form>
		</div>
	</div>
</div>

@endsection