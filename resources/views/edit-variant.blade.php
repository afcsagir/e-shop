@extends('layouts.app')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

@section('content')


Product No. {{ $productId }} <br><br><br>

<form enctype="multipart/form-data" action="{{ route('postVariance') }}" method="post">

<table>
	<tr>
		<th>No.</th>
		<th>Variance Combo</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Image</th>
	</tr>
@foreach ($variances as $key=>$variance)
	<tr>
		<td>{{ $loop->index +1 }}</td>
		<td>{{ $variance->combo }}</td>
		<td><input type="text" name="price{{ $key }}" value="{{ $variance->price }}" autocomplete="off"></td>
		<td><input type="text" name="quantity{{ $key }}" value="{{ $variance->quantity }}" autocomplete="off"></td>
		<td><img src="/uploads/products/{{ $variance->image }}" class="img-rounded" alt="product image" width="100" height="100"><input type="file" name="image{{ $key }}"></td>
	</tr>
@endforeach
</table>
<br>
<input type="hidden" name="productId" value="{{ $productId }}">
<input type="hidden" value="{{ Session::token() }}" name="_token" />
<button type="submit">Save</button>


</form>
@endsection