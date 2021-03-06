@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

               <!-- load bootstrap -->
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">


                <div class="page-header">
            <h1><span class="glyphicon glyphicon-flash"></span> Edit Your Data Plz</h1>
        </div>



        <!-- FORM STARTS HERE -->
        <form method="POST" action="{{url('/user-data-post')}}" name=""  novalidate>
                  {{ csrf_field() }}


            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="..." value="{{ (isset($getuserData->name)) ? $getuserData->name : '' }}" >
                <input type="hidden" name="id" value="{{ $getuserData->id }}">
            </div>

            <div class="form-group">
                <label for="name">Email (this email is used for login)</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="..." value="{{ (isset($getuserData->email)) ? $getuserData->email : '' }}">
            </div>
            <div class="form-group">
                <label for="name">Address</label>
                <input type="text" id="address1" class="form-control" name="address1" placeholder="..." value="{{ (isset($getuserData->address1)) ? $getuserData->address1 : '' }}">
            </div>
            <div class="form-group">
                            <label for="name">Delivery address</label>
                            <input type="text" id="deliveryaddress" class="form-control" name="deliveryaddress" placeholder="..." value="{{ (isset($getuserData->deliveryaddress)) ? $getuserData->deliveryaddress : '' }}">
            </div>
            <div class="form-group">
                            <label for="name">City</label>
                            <input type="text" id="city" class="form-control" name="city" placeholder="..." value="{{ (isset($getuserData->city)) ? $getuserData->city : '' }}">
            </div>
            <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="..." value="{{ (isset($getuserData->phone)) ? $getuserData->phone : '' }}">
            </div>
            <div class="form-group">
                            <label for="name">Zip</label>
                            <input type="text" id="zip" class="form-control" name="zip" placeholder="..." value="{{ (isset($getuserData->zip)) ? $getuserData->zip : '' }}">
            </div>
            <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" id="country" class="form-control" name="country" placeholder="..." value="{{ (isset($getuserData->country)) ? $getuserData->country : '' }}">
             </div>









            <button type="submit" class="btn btn-success">Confirmed</button>

        </form>

    </div>
</div>



@endsection