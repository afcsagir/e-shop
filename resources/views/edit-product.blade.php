@extends('layouts.app')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>


@section('content')


<div class="container padding-top-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Edit Product</h3>
        </div>

        <div class="panel-body">
    	<br>
        	<form enctype="multipart/form-data" action="{{ route('editProcess') }}" method="post" id="myform">
        		<label for="name">Product Name: </label>
        		<input type="text" name="name" class="form-control" value="{{ $product->name }}" /><br>
        		<label for="category">Product Category: </label>
        		<select name="category" id="category" class="form-control">
        			<option value="Choose">Choose</option>
        			<option value="Guitar">Guitars</option>
        			<option value="Amplifier">Amplifiers</option>
        			<option value="Stomp">Stomp Boxes & Effects</option>
        			<option value="String">Strings</option>
        			<option value="Accessory">Accessories</option>
        			<option value="Livepro">Live Pro-Audio</option>
        		</select><br>
        		
        		<label for="subCategory">Sub Category: </label>
        		<select name="subCategory" id="item" class="form-control"></select><br>
        		<div class="form-group">
                    <label class="control-label col-xs-2" for="type">Featured: </label>
                    <div class="col-xs-2">
                        <label class="radio-inline">
                            <input type="radio" name="feature" class="custom-control-input" id="featureYes" value="featureYes"> Yes
                        </label>
                    </div>
                    <div class="col-xs-2">    
                        <label class="radio-inline">
                            <input type="radio" name="feature" class="custom-control-input" id="featureNo" value="featureNo" checked> No
                        </label>
                    </div>    
                </div>        
                <br>
        		<label for="pic">Upload an Image: </label>
        		<img src="/uploads/products/{{ $product->pic }}" class="img-rounded" alt="product image" width="100" height="100">
                <br>
                <br>
        		<div class="col-lg-6 col-sm-6 col-12">
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Browse&hellip; <input type="file" style="display: none;" name="pic" id="pic">
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <span class="help-block">
                        You can select more images per variance in edit variance section
                    </span>
                </div>
                <br>
                <br>
                <br>
                <br>
        		<label for="description">Description: </label>
        		<textarea name="description" id="description">{{ $product->detail->description }}</textarea><br>
        		<label for="specification">Review Details: </label>
        		<textarea name="specification" id="specification">{{ $product->detail->specification }}</textarea><br>

        		<h3>Change Attribute Features & Prices</h3>
                <br>
               
                <div style="margin: none;">
                    <ul class="list group" style="width: 620px;">
                		@foreach($attributes as $key=>$attribute)
            			<li class="list-group-item">Attribute {{ ++$key  }}:  {{ $attribute->name }}           <br>           Values:   {{ $attribute->value }}</li>
                        @endforeach
                    </ul>
                </div>  
        		<br>
        		<input type="radio" name="choice" value="changeAtt"> Change Attribute or Values
                <br>
                <br>
                <div class="container-fluid" id="changeAtt" style="display: none;">
                    <table class="table table-hover table-striped">
                        @foreach($attributes as $key=>$attribute)
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">No. </th>
                                <th style="width: 200px; text-align: center;">Attributes</th>
                                <th style="width: 200px; text-align: center;">Values</th>
                            </tr>
                        </thead> 
                        <tbody>    
                            <tr>
                                <td style="width: 50px; text-align: center;">{{ $key +1 }}</td>
                                <td style="width: 200px; text-align: center;"><input class="form-control" type="text" name="editAttribute{{ $key }}" value="{{ $attribute->name }}"></td>
                                <td style="width: 200px; text-align: center;"><input class="form-control" type="text" name="editValue{{ $key }}" value="{{ $attribute->value }}"></td>
                            </tr>    
                        </tbody>  
                        @endforeach 
                    </table>
                </div><br>
                
        		
        		<input type="radio" name="choice" value="addAtt">    Add new Attributes and Values
                <br>
                <br>
        		<div class="input-group" id="addAtt" style="display: none;">
        			<span class="input-group-addon">The number of <u><strong><em>new</em></strong></u> attributes do you want to add: </span>
        			<input class="form-control" type="text" name="addNumber" value="0"> 
        		</div><br>

 
        		<input type="radio" name="choice" value="deleteAtt" checked>              Delete Attributes 
                <br>
                <br>
        		<div class="container-fluid" id="deleteAtt" style="display: none;">
        		  <div style="margin: none;">
                    <ul class="list group" style="width: 620px;">
                @foreach($attributes as $key=>$attribute)
        			 <li class="list-group-item">Attribute {{ ++$key  }}: {{ $attribute->name }}   <br>   Values: {{ $attribute->value }} <br> <input class="float-right" type="checkbox" name="delete[]" value="{{ $attribute->id }}"></li>
        		@endforeach
                    </ul>
                  </div>
        		</div><br>

        		<input type="radio" name="choice" value="priceQ">
                 Change Price or Quantity 
                <br>
                <br>

        		<input type="radio" name="choice" value="deletePro">
                 Delete Product 
                <br>
                <br>

        		
        		<input type="radio" name="choice" value="nothing" checked>
                Do Nothing 
                <br><br>

        		<button class="btn btn-primary btn-lg" type="submit">Change</button><br>
        		<input type="hidden" value="{{ $product->id }}" name="productId" />
        		<input type="hidden" value="{{ Session::token() }}" name="_token" /><br>
        		 
        		
        	</form>
        </div>    
    </div>
</div>



@endsection

<script>

tinymce.init({
  selector: '#description',  // change this value according to your HTML
  setup: function(editor) {
    editor.on('click', function(e) {
      console.log('Editor was clicked');
    });
  }
});

tinymce.init({
  selector: '#specification',  // change this value according to your HTML
  setup: function(editor) {
    editor.on('click', function(e) {
      console.log('Editor was clicked');
    });
  }
});


guitars=new Array('Acoustic Guitars', 'Electric Guitars', 'Bass Guitars');
amplifiers=new Array('Guitar Amps', 'Bass Guitar Amps');
stomp=new Array('Guitar Pedals & Effects', 'Bass Guitar Pedals & Effects');
strings=new Array('Guitar Strings', 'Bass Guitar Strings');
accessories=new Array('Cables, Snakes & Adapters', 'Stands', 'Harmonicas', 'Blank Media', 'Books & Videos', 'Other Accessories', 'Guitar Accessories', 'Bass Guitar Accessories', 'Keyboard Accessories');
livepro=new Array('Live Pro-Audio');

populateSelect();

$(function() {

      $('#category').change(function(){
        populateSelect();
    });
    
});


function populateSelect(){
    cat=$('#category').val();
    $('#item').html('');
    
    if(cat=='Choose'){

    }
    
    if(cat=='Guitar'){
        guitars.forEach(function(t) { 
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }
    
    if(cat=='Amplifier'){
        amplifiers.forEach(function(t) {
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }

    if(cat=='Stomp'){
        stomp.forEach(function(t) {
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }

    if(cat=='String'){
        strings.forEach(function(t) {
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }

    if(cat=='Accessory'){
        accessories.forEach(function(t) {
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }

    if(cat=='Livepro'){
        livepro.forEach(function(t) {
            $('#item').append('<option value='+t+'>'+t+'</option>');
        });
    }
    
    
    //$('.item option[value={!! $product->sub !!}]').attr('selected','selected');
} 

$(document).ready(function() {
    $("input[name=choice]").on( "change", function() {

         var typeValue = $(this).val();
         if (typeValue == "changeAtt") {
         	$("#changeAtt").show();
         	$("#addAtt").hide();
         	$("#deleteAtt").hide();
         } else if (typeValue == "addAtt") {
         	$("#changeAtt").hide();
         	$("#addAtt").show();
         	$("#deleteAtt").hide();
         } else if (typeValue == "priceQ") {
         	$("#changeAtt").hide();
         	$("#addAtt").hide();
         	$("#deleteAtt").hide();
         } else if (typeValue == "deleteAtt") {
         	$("#changeAtt").hide();
         	$("#addAtt").hide();
         	$("#deleteAtt").show();
         } else if (typeValue == "nothing") {
         	$("#changeAtt").hide();
         	$("#addAtt").hide();
         	$("#deleteAtt").hide();
         } 
         

    });

    //category = document.getElementById("#category");
    //$("form.category select").val('{!! $product->category !!}');
    $('.category option[value={!! $product->category !!}]').attr('selected','selected');
    //$('.item option[value={!! $product->sub !!}]').attr('selected','selected');
    $( "#category" ).trigger( "change" );
    $('#{!! $product->tag !!}').prop('checked',true);
});

</script>