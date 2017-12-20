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
		<a href="{{ url('report-by-date', ['time' => 'today']) }}">Today</a>
		<a href="{{ url('report-by-date', ['time' => 'seven']) }}">Last 7 Days</a>
		<a href="{{ url('report-by-date', ['time' => 'month']) }}">This Month</a>
		<a href="{{ url('report-by-date', ['time' => 'lastmonth']) }}">Last Month</a>
		<a href="{{ url('report-by-date', ['time' => 'year']) }}">This Year</a>
		<a href="{{ url('report-by-date', ['time' => 'lastyear']) }}">Last Year</a>
		<form method="post" action="{{ url('report-by-date-custom') }}">
			<input type="date" name="from">
			<input type="date" name="to">
			<input type="submit" name="submit">
			<input type="hidden" value="{{ Session::token() }}" name="_token" />
		</form> 

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Sold To</th>
					<th>On</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($sales as $sale)
			<tr>
				<td>{{ $sale->variance->product['name'] }}</td>
				<td>{{ $sale->quantity }}</td> 
				<td>{{ $sale->customer['name'] }}, {{ $sale->user['name'] }}</td> 
				<td>{{ $sale->updated_at }}</td>
			</tr>
		@endforeach
			</tbody>
		</table>

	</div>
	
</div>

@endsection