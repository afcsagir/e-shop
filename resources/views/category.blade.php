@extends('layouts.app')
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
@push('styles')
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endpush

@section('content')

		<div class="section outdiv" id="specialities">
 	     <div class="container-fluid">

        <form name="sortform" id="sortform" action="{{ route('getCategory', ['catName' => $catName, 'subName' => $subName ]) }}" method="get">
          <label for="sortby">Sort By</label>
          <select name="sortby" id="sortby">
            <option value="choose">Choose</option>
            <option value="nameA">Name A-Z</option>
            <option value="nameD">Name Z-A</option>
            <option value="priceA">Price (min-max)</option>
            <option value="priceD">Price (max-min)</option>
          </select>
          <input type="hidden" value="{{ Session::token() }}" name="_token" />
        </form>

    	  <div class="col-md-12"><h1 class="text-center"><span>{{$subName}} {{$catName}}s</span></h1>
    				<!--<p class="sub-headers text-center"></p>-->
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
         </div>
                  
       </div>  






{{ $products->links() }}              
@endsection

<script type="text/javascript">
  
  $(document).ready(function() {
    $('#sortby').on('change', function() {
       document.forms['sortform'].submit();
    });
  });

</script>


