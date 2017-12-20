@extends('layouts.app')

@section('content')

<div>
	<h1>New Orders</h1>


		
		@foreach($news as $new)

			
			{{ $new->variance->product->name }}<br>
			{{ $new->user->name }}, Id: {{ $new->user->id }}
			
			<a href="{{url('/process-order/'.$new->id)}}">
				<button type="button" class="btn btn-danger">
                	<span class="fa fa-remove"></span> Process
                </button>
            </a><hr>
		@endforeach

</div>

<div>
	<h1>Processing</h1>

	@foreach($processings as $processing)

			
			{{ $processing->variance->product->name }}<br>
			{{ $processing->user->name }}, Id: {{ $processing->user->id }}
			
			<a href="{{url('/deliver-order/'.$processing->id)}}">
				<button type="button" class="btn btn-danger">
                	<span class="fa fa-remove"></span> Complete
                </button>
            </a><hr>
		@endforeach
</div>

<div>
	<h1>Completed</h1>

	@foreach($completes as $complete)

			
			{{ $complete->variance->product->name }}<br>
			{{ $complete->user->name }}, Id: {{ $complete->user->id }}
			
			<hr>
		@endforeach
</div>






@endsection