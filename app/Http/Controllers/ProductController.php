<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

//use App\User;
use App\Product;
use App\Attribute;
use App\Variance;
use App\Detail;
use App\Cart;
use App\SpecialOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{



	public function getProduct()
	{
		if(\Auth::check()){
			$cart = DB::table('carts')->where('user_id',Auth::user()->id)->first();

	        if(!$cart){
	            $cart =  new Cart();
	            $cart->user_id=Auth::user()->id;
	            $cart->save();
	        }
    	}

		$products = DB::table('products')
					->where('tag', 'featureYes')
					->paginate(16);

		$title = 'Featured';

		return view('shop', ['products' => $products, 'title' => $title]);
	}

	public function getProductAll()
	{
		$products = DB::table('products')
					->paginate(16);

		$title = 'All';

		return view('shop', ['products' => $products, 'title' => $title]);
	}

	public function getAddProduct()
	{
		return view('add-product');
	}

	public function postAddProduct(Request $request)
	{
		$productName = ucfirst($request['name']);
		$productType = ucfirst($request['type']);
		$productCategory = ucfirst($request['category']);
		$productSub = ucfirst($request['subCategory']);
		$productFeat = $request['feature'];

		$description = $request['description'];
		$specification = $request['specification'];
		//$revHeader = $request['revheader'];
		//$revPara = $request['revpara'];

		$product = Product::where('name', $productName)->first();

		if ((!$product) && ($productType == "Variable")) {


			$product = new Product();
			$product->name = $productName;
			$product->type = $productType;
			$product->category = $productCategory;
			$product->sub = $productSub;
			$product->tag = $productFeat;

			if($request->hasfile('pic')) {
				$pic = $request->file('pic');
				$filename = 'p' . time() . '.' . $pic->getClientOriginalExtension();
				$path = 'uploads/products/' . $filename;
				Image::make($pic)->resize(null, 800, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->resizeCanvas(800, 800, 'center', false, 'ffffff')->save($path);
				$product->pic = $filename;
			}
			
			$product->save();

			$detail = new Detail;
			$detail->description = $description;
			$detail->specification = $specification;
			//$detail->revheader = $revHeader;
			//$detail->revpara = $revPara;
			$product->detail()->save($detail);
			
			if (isset($request['attQ'])) {
				$attQ = $request['attQ'];
				$n = 0;

				while ($n < $attQ) {
					$attribute = new Attribute();
					$product->attributes()->save($attribute);
					$n++;
				}
			}

			return view('add-attribute', ['productName' => $productName, 'attQ' => $attQ, 'productCategory' => $productCategory, 'productId' => $product->id]);

		} elseif ((!$product) && ($productType == "Simple")) {
			$product = new Product();
			$product->name = $productName;
			$product->type = $productType;
			$product->category = $productCategory;
			$product->sub = $productSub;
			$product->quantity = $request['simpleQ'];
			$product->price = $request['simplePrice'];
			$product->min = $request['simplePrice'];
			$product->tag = $productFeat;

			if($request->hasfile('pic')) {
				$pic = $request->file('pic');
				$filename = 'p' . time() . '.' . $pic->getClientOriginalExtension();
				$path = 'uploads/products/' . $filename;
				Image::make($pic)->resize(null, 800, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->resizeCanvas(800, 800, 'center', false, 'ffffff')->save($path);
				$product->pic = $filename;
			}
			
			$product->save();

			$detail = new Detail;
			$detail->description = $description;
			$detail->specification = $specification;
			//$detail->revheader = $revHeader;
			//$detail->revpara = $revPara;
			$product->detail()->save($detail);

			$variance = new Variance();
			$variance->price = $request['simplePrice'];
			$product->variances()->save($variance);

			return view('home', ['productAdded' => "New product has been added"]);

		} else return view('add-product', ['productExists' => "Product with this name already exists, please choose a different name"]);
	}




	public function postAddAttribute(Request $request)
	{
		$productId = $request['productId'];
		//$productName = $request['productName'];
		$attQ = $request['attQ'];

		$product = Product::where('id', $productId)->first();

		$attributes = Attribute::where('product_id', $product->id)->get();

		$send = array('product_id' => $product->id, 'attQ' => $attQ);
		
		$count = 0;
		foreach ($attributes as $attribute) {
			$attribute->name = ucwords($request['name'.$count]);

			$attribute->value = ucwords($request['value'.$count]);
			$attribute->save();

			$send += ['attributeId'.$count => $attribute->id];
			$count++;
		}

		//for($a = 0; $a < $attQ; $a++) {
			//${'attributeName'.$a} = ucwords($request['name'.$a]);
			
			//$send += ['attributeName'.$a => ${'attributeName'.$a}];

		//}

		function combinations($arrays, $i = 0) {
		    if (!isset($arrays[$i])) {
		        return array();
		    }
		    if ($i == count($arrays) - 1) {
		        return $arrays[$i];
		    }

		    // get combinations from subsequent arrays
		    $tmp = combinations($arrays, $i + 1);

		    $result = array();

		    // concat each array from tmp with each element from $arrays[$i]
		    foreach ($arrays[$i] as $v) {
		        foreach ($tmp as $t) {
		            $result[] = is_array($t) ? 
		                array_merge(array($v), $t) :
		                array($v, $t);
		        }
		    }

		    return $result;
		}

		global $comboArray;
		

		function makeAddVariance($product, $attributes, $comboArray, $attQ)
		{	
			$comboArray = array();
			$count = 0;
			$arrayOfArrays = array();
			foreach ($attributes as $attribute) {
				${'attArray'.$count} = explode(", ", $attribute->value);
				//${'attArray'.$count} = implode(", ", ${'attArray'.$count});
				array_push($arrayOfArrays, ${'attArray'.$count});
				$count++;
			}
			//$ttArray0 = implode("a, ", $attArray0);

			$combos = combinations($arrayOfArrays);
			

			foreach ($combos as $combo) {
				if ($attQ<2){
					array_push($comboArray, $combo);
					$variance = new Variance();
					$variance->combo = $combo;
					$product->variances()->save($variance);
				}else{
					$combo = implode(", ", $combo);
					array_push($comboArray, $combo);
					$variance = new Variance();
					$variance->combo = $combo;
					$product->variances()->save($variance);}
			} 
			
			return $comboArray;
		}

		

		$comboArray = makeAddVariance($product, $attributes, $comboArray, $attQ);
		//$send = array('product_id' => $product->id, 'attQ' => $attQ);
		//$combos = array('a' => "a", 'b' => "b");
		//return view('add-variant')->with('send', $send);
		return view('add-variant', ['productId' => $product->id])->with('combos', $comboArray);
	}




	public function postAddVariance(Request $request)
	{
		$productId = $request['productId'];
		//$product = Product::where('name', $productName)->first();
		$variances = Variance::where('product_id', $productId)->where('status', 'valid')->get();
		$quantity = 0;

		foreach ($variances as $key=>$variance) {
			$variance->price = $request['price'.$key];
			$variance->quantity = $request['quantity'.$key];


			if($request->hasfile('image'.$key)) {
				if ($variance->image !== 'default.jpg') {
					$path = 'uploads/products/' . $variance->image;
					\File::delete($path);
				}
				$image = $request->file('image'.$key);
				$filename = time() . $variance->id . '.' . $image->getClientOriginalExtension();
				$path = 'uploads/products/' . $filename;
				Image::make($image)->resize(null, 800, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->resizeCanvas(800, 800, 'center', false, 'ffffff')->save($path);
				$variance->image = $filename;
			}


			$variance->save();
			if ($variance->price !== null) {
				$min = $max = $variance->price;
			}
		}

		if (!isset($min) && !isset($max)) {
				$min = $max = 0;
		}

		if (count($variances) > 1){
			foreach ($variances as $key=>$variance) {
				$quantity += $variance->quantity;
				if ($variance->price > $max && $variance->price !== null) {
					$max = $variance->price;
				}
				if ($variance->price < $min && $variance->price !== null) {
					$min = $variance->price;
				}
			}

			$product = Product::where('id', $productId)->first();
			$product->price = $min." to Tk ".$max;
			$product->min = $min;
			$product->quantity = $quantity;
			$product->save();
		} else {
			$product = Product::where('id', $productId)->first();
			$product->price = $min;
			$product->min = $min;
			$product->quantity = $variance->quantity;
			$product->save();
		}

		

		return view('home', ['productAdded' => "Product and it's Variance has been added"]);
	}

	public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
				//dd($product);
        $title = 'Searched';

        return view('shop', compact('products', 'query', 'title'));
    }

    public function special(Request $request)
    {
    	//$this->middleware('auth');
    	if ($request['name'] !== null) {
    		$special = new SpecialOrder;
    		$special->name = $request['name'];
    		$special->description = $request['description'];
    		$special->user_id=Auth::user()->id;

    		if($request->hasfile('image')) {
				//if ($variance->image !== 'default.jpg') {
				//	$path = 'uploads/products/' . $variance->image;
				//	\File::delete($path);
				//}
				$image = $request->file('image');
				$filename = 's' . time() . $special->id . '.' . $image->getClientOriginalExtension();
				$path = 'uploads/products/' . $filename;
				Image::make($image)->resize(null, 800, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->resizeCanvas(800, 800, 'center', false, 'ffffff')->save($path);
				$special->image = $filename;
			}

			$special->save();
    	}

    	return view('special');
    }

}

