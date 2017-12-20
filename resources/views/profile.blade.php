@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">

               <!-- load bootstrap -->
            <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->


                <div class="page-header">
            <h1>Edit Yours Profile</h1>

        </div>

        <!-- Table-to-load-the-data Part -->
            <table class="table table-bordered">

                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Delivery Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Zip</th>
                        <th>Country</th>




                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $val)
                    <tr>


                        <td>{{$val->name}}</td>
                        <td>{{$val->email}}</td>
                        <td>{{$val->address1}}</td>
                        <td>{{$val->deliveryaddress}}</td>
                        <td>{{$val->city}}</td>
                        <td>{{$val->phone}}</td>
                        <td>{{$val->zip}}</td>
                        <td>{{$val->country}}</td>




                        <td>


                             <a href="{{ url('/edit-user-data/').'/'.$val->id }}" button class="btn btn-success">Edit</a>


                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            <a href="{{ url('/wishlist/') }}" button class="btn btn-success">Wishlist</a>

            <div>
                <h1>Current Orders</h1>
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
            </div>

            <div>
                <h1>Shopping History</h1>
                <h3>Your Loyalty Points: {{ $loyaltyPoints }}</h3>
                    @foreach($histories as $history)
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="{{ route('product', ['productId' => $history->variance->product->id]) }}"> <img class="media-object" src="/uploads/products/{{ $history->variance->product->pic }}" style="width: 100px; height: 72px;"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="{{ route('product', ['productId' => $history->variance->product->id]) }}">{{$history->variance->product['name']}}</a></h4>
                                    </div>
                                </div></td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>${{$history->variance['price']}}</strong></td>
                            
                        </tr>
                    @endforeach
                    
            </div>

    </div>
</div>



@endsection