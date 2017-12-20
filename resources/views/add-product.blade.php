@extends('layouts.app')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>

@section('content')
<div class="container padding-top-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Add new product</h2>
        </div>

        <div class="panel-body">
        	<form enctype="multipart/form-data" action="{{ route('postProduct') }}" method="post">

        		<label for="name">Product Name: </label>
        		<input type="text" name="name" class="form-control" /><br>

            <div class="form-group">    
        		<label class="control-label col-xs-2" for="type">Product Type: </label>
                    <div class="col-xs-2">
                        <label class="radio-inline">
                    		<input type="radio" name="type" class="custom-control-input" id="typeSimple" value="simple" checked> Simple
                        </label>
                    </div>
                    <div class="col-xs-2">    
                        <label class="radio-inline">
                    		<input type="radio" name="type" class="custom-control-input" id="typeVariable" value="variable"> Variable
                        </label>
                    </div>  
                </div>        
                <br>
                <br>
        		<label for="category">Product Category: </label>
        		<select class="form-control" name="category" id="category">
        			<option value="choose">Choose</option>
        			<option value="Guitar">Guitars</option>
        			<option value="Amplifier">Amplifiers</option>
        			<option value="Stomp">Stomp Boxes & Effects</option>
        			<option value="String">Strings</option>
        			<option value="Accessory">Accessories</option>
        			<option value="Livepro">Live Pro-Audio</option>
        		</select><br>
        		
        		<label for="subCategory">Sub Category: </label>
        		<select class="form-control" name="subCategory" id="item"></select><br>
        		
        		<div id="attQ" style="display: none;">
        			<label for="attQ">Number of Attributes: </label>
        			<input class="form-control" type="text" name="attQ" />
        		</div>
        		<div id="simplePrice">
        			<label for="simplePrice">Price of Product: </label>
        			<input class="form-control" type="text" name="simplePrice" />
        		</div>
                <br>
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
        		<div id="simpleQ">
        			<label for="simpleQ">Quantity of Product: </label>
        			<input class="form-control" type="text" name="simpleQ" />
        		</div>
                <br>
        		<label for="pic">Upload an Image: </label>
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
        		<textarea name="description" id="description"></textarea><br>
        		<label for="specification">Specification: </label>
        		<textarea name="specification" id="specification"></textarea><br>
        		<input type="hidden" value="{{ Session::token() }}" name="_token" />
        		<button type="submit" class="btn btn-primary btn-lg">Save</button>
        	</form>
        </div>    
    </div>
</div>

@if(isset($productExists))
                     <div class="alert alert-danger">
                         <a href="#" class="close" data-dismiss="danger" aria-label="close">&times;</a>
                         {{ $productExists }}
                         
                     </div>
                @endif
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

$(document).ready(function() {
    $("input[name=type]").on( "change", function() {

         var typeValue = $(this).val();
         if (typeValue == "simple") {
         	$("#attQ").hide();
         	$("#simpleQ").show();
         	$("#simplePrice").show();
         } else if (typeValue == "variable") {
         	$("#attQ").show();
         	$("#simpleQ").hide();
         	$("#simplePrice").hide();
         }
         
         
    });
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
    
} 
</script>

