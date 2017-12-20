@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endpush

@section('content')
<br><br><br>
<div class="text-center">
	<h3>Your order has been received</h3>
	<h4>Our staff will contact you shortly</h4>
</div>
<br><br><br><br>
<!--<div>
				@foreach($items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="{{ route('product', ['productId' => $item->variance->product->id]) }}"> <img class="media-object" src="/uploads/products/{{ $item->variance->product->pic }}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{ route('product', ['productId' => $item->variance->product->id]) }}">{{$item->variance->product['name']}}</a></h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->variance['price']}}</strong></td>
                      
                    </tr>
                @endforeach
</div>-->

@endsection