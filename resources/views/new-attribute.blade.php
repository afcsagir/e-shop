@extends('layouts.app')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

@section('content')
{{$productId}}

Att Quantity: {{ $attQ }}

<div class="container padding-top-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Add new attribute names and it's values:</h3>
		</div>
		<div class="panel-body">
			<br>
			<form class="form-group" action="{{ route('moreAttribute') }}" method="post">
				@for($i = 0; $i < $attQ; $i++)
					<label for="name{{ $i }}">Attribute Name {{ $i + 1 }}: </label>
					<input class="form-control" type="text" name="name{{ $i }}" />
					<br>
					<label for="value{{ $i }}">Value/s: </label>
					<input class="form-control" type="text" name="value{{ $i }}" />
					<hr>
					<br>
				@endfor
				<input type="hidden" name="productId" value="{{ $productId }}">
				<input type="hidden" name="attQ" value="{{ $attQ }}">
				<button class="btn btn-success" type="submit">Save</button>
				<input type="hidden" value="{{ Session::token() }}" name="_token" />
			</form>
		</div>
	</div>
</div>

@endsection