@extends('layouts.app')

@section('content')

<div class="right_col" role="main">
	<div class="page-title">
      <div class="title_left">
        <h3>Reports</h3>
      </div>
    </div>




                            
    <div class="clearfix"></div>
	<div class="col-md-12">
		<a href="#"></a>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Quantity</th>
					<th>Id</th>
					<th>Product</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($products as $product)
			<tr>
				<td>{{$product->tquantity}}</td>
				<td>{{ $product->variance_id }}</td> 
				<td>{{ $product->variance->product['name'] }}</td> 
				<td>{{ $product->variance->product['price'] }}</td>
			</tr>
		@endforeach
			</tbody>
		</table>
	</div>
	

</div>

@endsection