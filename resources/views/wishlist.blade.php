@extends('layouts.app')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>


@section('content')


    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center">Price</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/uploads/products/{{ $item->variance->product->pic }}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{$item->variance->product['name']}}</a>
                                        {{ $item->variance->combo }}</h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->variance['price']}}</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="{{url('/wish-remove/'.$item->id)}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach

                
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="{{ url('/') }}" button class="btn btn-default">Continue Shopping</a>
                    </td>
                    <td>
                        
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
