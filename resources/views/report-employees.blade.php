@extends('layouts.app')

@section('content')

<div class="right_col" role="main">
	<div class="page-title">
      <div class="title_left">
        <h3>Reports</h3>
      </div>
    </div>




                            
    <div class="clearfix"></div>
	<div class="col-md-6">
		<h3>July, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports177 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays7array as $addedDays)
			{{$addedDays}},
		@endforeach

		<h3>August, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports178 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays8array as $addedDays)
			{{$addedDays}},
		@endforeach
	

		<h3>September, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports179 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays9array as $addedDays)
			{{$addedDays}},
		@endforeach
	</div>
	<div class="col-md-6">
		<h3>October, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports1710 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays10array as $addedDays)
			{{$addedDays}},
		@endforeach
	

		<h3>November, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports1711 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays11array as $addedDays)
			{{$addedDays}},
		@endforeach
	
	
		<h3>December, 17</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Hours Worked</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($reports1712 as $report)
			<tr>
				<td>{{$report->name}}</td>
				<td>{{$report->tquantity/60/60}} Hrs</td>
			</tr>

		@endforeach

			</tbody>
		</table><br>
		Days Added:
		@foreach ($addedDays12array as $addedDays)
			{{$addedDays}},
		@endforeach
	</div>
	<div class="col-md-6">

	</div>

</div>

@endsection