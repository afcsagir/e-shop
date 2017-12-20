@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="/uploads/slider/1.jpg" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
          <!--<h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>-->
        </div>
      </div>

      <div class="item">
        <img src="/uploads/slider/5.jpg" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          <!--<h3>Chicago</h3>
          <p>Thank you, Chicago!</p>-->
        </div>
      </div>
    
      <div class="item">
        <img src="/uploads/slider/4.jpg" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <!--<h3>New York</h3>
          <p>We love the Big Apple!</p>-->
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

		<div class="section outdiv" id="specialities">
 	     <div class="container-fluid">
    	  <div class="col-md-12"><h1 class="text-center"><span>{{$title}} Products</span></h1>
    				<p class="sub-headers text-center">Check out our latest and top gears!</p>
	@foreach($products as $product)		
                <div class="speciality">
	

		            <a href="{{ route('product', ['productId' => $product->id]) }}"><div class="spe-prods">
						<div class="mainbox">
							
	                        <img src="/uploads/products/{{ $product->pic }}" alt="">
	                        <h3>{{ $product->name }}</h3>
	                        <p>Tk {{ $product->price }}</p>
	                        <!--<a href="#" class="buybtn">Add to Cart</a>-->
						</div>
						<!--<div class="price-big">
							<div>
								<div class="floating-price">
									<h3>{{ $product->price }}</h3>
								</div>
								<div class="month">
									<p>{{ $product->name }}<br>{{ $product->price }} /= Tk</p>
								</div>
							</div>
							<div class="ordersection">
									<a href="#" class="buybtn">Add to Cart</a>
							</div>
							
						</div>-->
					</div></a>

				

     

              </div>
        @endforeach


           </div>   

            @if ($title == 'Featured') 
              <a href="{{ route('showProductAll') }}" style="text-align: center; text-decoration: none;"><h3>Show More</h3></a>
            @elseif ($title == 'All')
              {{ $products->links() }}
            @endif
         </div>
                  
       </div>  






{{-- $products->links() --}}              
@endsection




