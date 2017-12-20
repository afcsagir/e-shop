@extends('layouts.app')
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.js')}}"></script>

@push('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')

<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
				<!--<div class="col-md-12">-->
						<div class="product col-md-4 service-image-left">
	                    
							<center>
								<img id="item-display" src="/uploads/products/{{ $product->pic }}" alt=""></img>

								<!-- The Modal -->
								<div id="myModal" class="modal">

								  <!-- The Close Button -->
								  <span class="close">&times;</span>

								  <!-- Modal Content (The Image) -->
								  <img class="modal-content" id="img01">

								  <!-- Modal Caption (Image Text) -->
								  <div id="caption"></div>
								</div>
							</center>
						</div>
						
						<!--<div class="service1-items col-sm-2 col-md-2">
							<center>
								<a id="item-1" class="service1-item">
									<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
								</a>
								<a id="item-2" class="service1-item">
									<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
								</a>
								<a id="item-3" class="service1-item">
									<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
								</a>
							</center>
						</div>-->
					<!--</div>-->
						
						<div class="col-md-4">
							<div class="product-title"><h2>{{ $product->name }}</h2></div>
							<div class="product-desc"></div>
							<!--<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>-->
							<hr>
							<form>
								@foreach($attributes as $i => $attribute)
									<label for="select{{ $i }}">{{ $attribute->name }}: </label>
									<select class="selectpicker" name="select{{ $i }}" id="select{{ $i }}" onchange="myFunction();"></select><br><br>
								@endforeach
							</form>


							<div class="product-price">Tk <span id="product-price">{{ $product->price }}</span></div>
							<div class="product-stock" id="product-stock"></div>
							<hr>



							<div class="count-input space-bottom" id="count-input" style="visibility: hidden;">
                                <a class="incr-btn" data-action="decrease" href="#">–</a>
                                <input class="quantity" id="quantity" type="text" name="quantity" value="1"/>
                                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
                            </div>



							<div class="btn-group cart">
								<a href="" role="button" class="btn btn-success" id="addToCart">
									Add to Cart
								</a>
							</div>
							<div class="btn-group wishlist">
								<a href="" role="button" class="btn btn-success" id="addWishList">
									Add to Wishlist
								</a>
							</div>
						</div>

						<div class="col-md-3">
							<h3>Related Products:</h3>
			 				@foreach($getSimilar as $item)
			                    <tr>
			                        <td class="col-sm-8 col-md-6">
			                            <div class="media">
			                                <a class="thumbnail pull-left" href="{{ route('product', ['productId' => $item->id]) }}"> <img class="media-object" src="/uploads/products/{{ $item->pic }}" style="width: 100px; padding-left: 5px;"> </a>
			                                <div class="media-body"><hr>
			                                    <h4 class="media-heading"><a href="{{ route('product', ['productId' => $item->id]) }}">&nbsp;{{$item->name}} </a>Tk {{$item->price}}</h4>
			                                </div>
			                            </div></td>
			                        <td class="col-sm-1 col-md-1" style="text-align: center">
			                        </td>
			                        <td class="col-sm-1 col-md-1 text-center"></td>
			                        <td class="col-sm-1 col-md-1 text-center"><strong></strong></td>
			                        
			                    </tr>
			                @endforeach
						</div>
			</div> 
		</div>

		<div class="container-fluid">		
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
						<li><a href="#service-two" data-toggle="tab">SPECIFICATION</a></li>
						<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							
								<!--<div class="tab-pane fade in active" id="service-one">-->
						 <br>
							<section class="container">
								<div>{!!$product->detail['description']!!}</div>
							</section>
										  
						</div>
					<div class="tab-pane fade" id="service-two">
						<br>
						<section class="container">
								<div>{!!$product->detail['specification']!!}</div>
						</section>
						
					</div>
					<div class="tab-pane fade" id="service-three">
						<section class="container">
							<div class="col-md-4">
							@foreach ($getrevs as $getrev)
							<div>
								<h2>{{ $getrev->revheader }}</h2>
								<p>{{ $getrev->revpara }}</p>
								<h6>by {{ $getrev->user->name }} {{ $getrev->created_at }}</h6>
								
							</div>
							@endforeach
							</div>
							<div class="panel-body col-md-3">
								<h3>Your Review</h3>
								<form class="form-group" method="post" action="{{ route('postReview') }}"><br>
									<label for="revheader">Review Header: </label>
									<input class="form-control" type="text" name="revheader"><br>
									<label for="revpara">Review Details: </label>
									<textarea class="form-control" name="revpara" id="revpara"></textarea><br>
									<button class="form-control" type="submit">Post</button><br>
									<input type="hidden" value="{{ $product->id }}" name="productId" />
									<input type="hidden" value="{{ Session::token() }}" name="_token" /><br>
								</form>
							</div>
							
						</section>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>



@endsection

<script type="text/javascript">

//var varId = '';


	function myFunction() {

		var objAtt, i = "";
	    var objAtt = JSON.parse('{!! json_encode($attributes) !!}');

	    var selects = [];
		//for (i in objAtt) {
		for (i=0;i<Object.keys(objAtt).length;i++) {
		    
		    selects[i] = document.getElementById('select'+i+'').value;
		    
		}

		var selectsJoin = selects.join(", ");
		//document.getElementById("demo").innerHTML = "You selected: " + selectsJoin;

		//$('select > option:selected').each(function() {
		//    document.getElementById("demo").innerHTML = ($(this).text() + ' ' + $(this).val());
		//});

	
		
		var objVar, j, combo = "";
	    var objVar = JSON.parse('{!! json_encode($variance) !!}');

	    for (j in objVar) {
	    	combo = objVar[j].combo;

	    	//document.getElementById("product-price").innerHTML = objVar[0].combo;
	    	if (combo == selectsJoin) {
	    		if (objVar[j].price === null || objVar[j].quantity === null || objVar[j].quantity === 0) {
	    			document.getElementById("product-stock").innerHTML = 'Out of Stock';
	    			document.getElementById("product-price").innerHTML = objVar[j].price;
		    		varId = objVar[j].id;
		    		//varQ = objVar[j].quantity;
	    			varId = objVar[j].id;
	    			$('#addToCart').prop('href', '/product/');
	    			$('#addWishList').prop('href', '/add-to-wishlist/'+varId);
	    			$( ".count-input" ).css("visibility", "hidden");
	    			$('#item-display').fadeOut(1).prop('src', '/uploads/products/'+objVar[j].image).fadeIn(400);
	    			//document.getElementById("product-price").innerHTML = objVar[j].price;
	    		//varId = objVar[j].id;
	    		//$('#addToCart').prop('href', '/addProduct/'+varId);
	    		//$('#addWishList').prop('href', '/add-to-wishlist/'+varId);
	    			//'{{url("/addProduct/'+ varId +'/")}}');
	    		} else {
	    			document.getElementById("product-stock").innerHTML = 'In Stock';
		    		document.getElementById("product-price").innerHTML = objVar[j].price;
		    		varId = objVar[j].id;
		    		varQ = objVar[j].quantity;
		    		//$('#addToCart').prop('href', '/addProduct/'+varId+'/'+ $('#quantity').val());
		    		$( ".count-input" ).css("visibility", "visible");
		    		$('#addWishList').prop('href', '/add-to-wishlist/'+varId);
		    		$('#addToCart').prop('href', '/addProduct/'+varId+'/'+ $('#quantity').val());
		    		$('#item-display').fadeOut(1).prop('src', '/uploads/products/'+objVar[j].image).fadeIn(400);
		    		//$('#addWishList').prop('href', '/add-to-wishlist/'+varId);
	    			//'{{url("/addProduct/'+ varId +'/")}}');
	    		}
	    	} 
	    	
	    }


	}
		

	$(document).ready(function() {

		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('item-display');
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
		    modal.style.display = "block";
		    modalImg.src = this.src;
		    captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		  modal.style.display = "none";
		}


		///////

		var objVar, i = "";
	    var objVar = JSON.parse('{!! json_encode($variance) !!}');

		var objAtt, vals = "";
		var j, k, l = "";
		var objAtt = JSON.parse('{!! json_encode($attributes) !!}');

		for (j in objAtt) {
			vals = objAtt[j].value;
			
			var values = vals.split(', ');

			var options = '<option value="Choose">Choose</option>';

			for (k=0; k<values.length; k++) {
				options += '<option value="'+ values[k] +'">'+ values[k] +'</option>';
			}
			
			$("#select"+j).append(options);			

		};
		
		var ifSimple = "";
		ifSimple = "{!! $product->type !!}";
		//var vId = "";
		var quantity = "";
		
		//document.getElementById("demo").innerHTML = ifSimple;

		if ( ifSimple == "Simple" ) {
			var objVar = "";
	    	var objVar = JSON.parse('{!! json_encode($variance) !!}');

			for (l in objVar) {
				vId = objVar[l].id;
				//quantity = objVar[l].quantity;
			}

			quantity = "{!! $product->quantity !!}";

			if (quantity === null || quantity === '0') {
				document.getElementById("product-stock").innerHTML = 'Out of Stock';
			} else {
				document.getElementById("product-stock").innerHTML = 'In Stock';
				$( ".count-input" ).css("visibility", "visible");
				//$stock = $quantity;
			}



			$('#addToCart').prop('href', '/addProduct/'+vId+'/'+ $('#quantity').val());
    		$('#addWishList').prop('href', '/add-to-wishlist/'+vId);

		}
	    

	var type = "{!! $product->type !!}";
		
	$(".incr-btn").on("click", function (e) {
        var $button = $(this);
        var oldValue = $button.parent().find('.quantity').val();
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ((oldValue<(ifSimple == 'Simple' ? {!! $product->quantity !!} : varQ)) && $button.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
        	if (oldValue = (ifSimple == 'Simple' ? {!! $product->quantity !!} : varQ)) {
        		newVal = 1;
                $button.addClass('inactive');
        	}
            // Don't allow decrementing below 1
            else if (oldValue > 1 && $button.data('action') == "decrease") {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                //newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        //$('#addToCart').prop('href', '/addProduct/'+varId+'/'+newVal);
        if ( type == 'Variable') {
        	$('#addToCart').prop('href', '/addProduct/'+varId+'/'+newVal);
        	$('#addWishList').prop('href', '/add-to-wishlist/'+newVal);
    	} else if ( type == 'Simple') {
    	    $('#addToCart').prop('href', '/addProduct/'+vId+'/'+newVal);
    	    $('#addWishList').prop('href', '/add-to-wishlist/'+newVal);
    	}
        e.preventDefault();
        //$('#addToCart').prop('href', '/addProduct/'+varId+'/'+ $('#quantity').val());
    });



	});


</script>