@extends('layouts.app')
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
@section('content')
<div class="container padding-top-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>All Products</h3>
        </div>

        <div class="panel-body">
          <div class="container-fluid">
            <h4>Filter</h4>
            <form class="form-inline" action="{{ route('allProducts') }}" method="get">
              <label for="category">Product Category: </label>
              <select class="form-control" name="category" id="category">
                <option value="choose">Choose</option>
                <option value="Guitar">Guitars</option>
                <option value="Amplifier">Amplifiers</option>
                <option value="Stomp">Stomp Boxes & Effects</option>
                <option value="String">Strings</option>
                <option value="Accessory">Accessories</option>
                <option value="Livepro">Live Pro-Audio</option>
              </select>
            
              <label for="subCategory">Sub Category: </label>
              <select class="form-control" name="subCategory" id="item"></select>
                <input type="hidden" value="{{ Session::token() }}" name="_token" />
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
          </div>  

          	<table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Product ({{ $count }})</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>

          @foreach($products as $product)

                <tr>
                  <td><a href="{{ route('editProduct', ['productId' => $product->id]) }}"><h4>{{ $product->name }}</h4></a></td>
                  <td>{{ $product->type }}</td>
                  <td>{{ $product->category }}</td>
                  <td>{{ $product->sub }}</td>
                  <td>Tk {{ $product->price }}</td>
                  <td>{{-- $product->quantity --}}
                    @if($product->type == 'Variable')
                      {{$product->quantity}}
                    @elseif($product->type == 'Simple')
                      {{ $product->quantity }}
                    @endif
                  </td>
                  <td><img src="/uploads/products/{{ $product->pic }}" class="img-rounded" alt="product image" width="100" height="100"></td>
                </tr>
      

          @endforeach

              </tbody>
            </table>
        </div>    
    </div>
</div>

@endsection

<script type="text/javascript">
guitars=new Array('Choose', 'Acoustic Guitars', 'Electric Guitars', 'Bass Guitars');
amplifiers=new Array('Choose', 'Guitar Amps', 'Bass Guitar Amps');
stomp=new Array('Choose', 'Guitar Pedals & Effects', 'Bass Guitar Pedals & Effects');
strings=new Array('Choose', 'Guitar Strings', 'Bass Guitar Strings');
accessories=new Array('Choose', 'Cables, Snakes & Adapters', 'Stands', 'Harmonicas', 'Blank Media', 'Books & Videos', 'Other Accessories', 'Guitar Accessories', 'Bass Guitar Accessories', 'Keyboard Accessories');
livepro=new Array('Choose', 'Live Pro-Audio');

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
