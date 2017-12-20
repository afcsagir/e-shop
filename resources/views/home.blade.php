@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    @if(Auth::check() && Auth::user()->type == 'admin')

                    <a href="{{ route('addProduct') }}" button class="btn btn-success">Add Product</a>
                    <a href="{{ route('allProducts') }}" button class="btn btn-success">Edit Products</a><br><br>
                    <a href="{{ url('/orders/') }}" button class="btn btn-success">Orders</a>
                    <a href="{{ url('/users/') }}" button class="btn btn-success">Users</a>
                    <a href="{{ url('/customer/') }}" button class="btn btn-success">Customers</a><br><br>
                    <a href="{{ url('/report-by-date/') }}" button class="btn btn-success">Sales By Date</a>
                    <a href="{{ url('/report-by-product/') }}" button class="btn btn-success">Sales By Product</a><br><br>
                    <a href="{{ url('/report-employees/') }}" button class="btn btn-success">Employee</a><br><br>
                    <a href="#" button class="btn btn-success">Upload Simple Products</a>
                    <a href="#" button class="btn btn-success">Upload Employees</a><br><br>
                    <a href="#" button class="btn btn-success">Product Returns</a>
                    @endif
                </div>
                @if(isset($productAdded))
                     <div class="alert alert-success">
                         <a href="#" class="close" data-dismiss="success" aria-label="close">&times;</a>
                         {{ $productAdded }}
                         
                     </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
