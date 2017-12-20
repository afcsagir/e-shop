<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Product;
use App\Attribute;
use App\Variance;
use App\Detail;
use Illuminate\Http\Request;
use Image;

class ProductEditController extends Controller
{
	public function getEditProducts(Request $request)
	{
		if ($request->has('category') && ($request['subCategory'] !== 'Choose')) {
		    $category = $request['category'];
			$sub = $request['subCategory'];
			$products = DB::table('products')->where('category', $category)->where('sub', $sub)->get();
			$count = count($products);
						//->paginate(5);

		} elseif ($request->has('category') && ($request['subCategory'] == 'Choose')) {
		    $category = $request['category'];
			//$sub = $request['subCategory'];
			$products = DB::table('products')->where('category', $category)->get();
			$count = count($products);
						//->paginate(5);

		} else {
			$products = DB::table('products')->get();
			$count = count($products);
		}
		
		return view('all-products', ['products' => $products, 'count' => $count]);
	}



	public function getEditProduct($productId)
	{
		$product = Product::where('id', $productId)->first();

		$attributes = Attribute::where('product_id', $productId)->get();

		return view('edit-product', ['product' => $product, 'attributes' => $attributes]);
	}



	public function postEditProduct(Request $request)
	{
		$optionChoice = $request['choice'];
		$productName = $request['name'];

		$product = Product::where('id', $request['productId'])->first();

		$details = Detail::where('product_id', $request['productId'])->first();

			//$product = new Product();
		if ($request['name'] !== $product->name) {
			$product->name = $productName;
		}
		
		//$product->type = $productType;
		if ($request['category'] !== $product->category) {
			$product->category = $request['category'];
		}

		if ($request['feature'] !== $product->tag) {
			$product->tag = $request['feature'];
		}

		if ($request['subCategory'] !== $product->sub) {
			$product->sub = $request['subCategory'];
		}

		if ($request['description'] !== $details->description) {
			$details->description = $request['description'];
		}

		if ($request['specification'] !== $details->specification) {
			$details->specification = $request['specification'];
		}

		//$desHeader = $request['desheader'];
		//if ($request['revheader'] !== $details->revheader) {
		//	$details->revheader = $request['revheader'];
		//}

		//if ($request['revpara'] !== $details->revpara) {
		//	$details->revpara = $request['revpara'];
		//}

		if($request->hasfile('pic')) {
				if ($product->pic !== 'default.jpg') {
					$path = 'uploads/products/' . $product->pic;
					\File::delete($path);
				}
				$pic = $request->file('pic');
				$filename = 'm' . time() . '.' . $pic->getClientOriginalExtension();
				$path = 'uploads/products/' . $filename;
				Image::make($pic)->resize(null, 800, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->resizeCanvas(800, 800, 'center', false, 'ffffff')->save($path);
				$product->pic = $filename;
			}

		$product->save();
		$details->save();

		$attributes = Attribute::where('product_id', $request['productId'])->get();
		$attQ= count($attributes);

		if ($optionChoice == "changeAtt") {


			
			$valChanged = 0;

			foreach ($attributes as $count=>$attribute) {

				if ($request['editAttribute'.$count] != $attribute->name) {
					$attribute->name = $request['editAttribute'.$count];
				}

				if ($request['editValue'.$count] != $attribute->value) {
					$attribute->value = $request['editValue'.$count];
					$valChanged++;
				}

				$attribute->save();
				

				//$attribute->name = "i";
				//$attribute->save();
			//$attribute->name = ucwords($request['name'.$count]);

				//$attribute = new Attribute();
				//$product->attributes()->save($attribute);
				//$n++;
			}



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
					} else {
						$combo = implode(", ", $combo);
						array_push($comboArray, $combo);
						$variance = new Variance();
						$variance->combo = $combo;
						$product->variances()->save($variance);
					}
				} 
				
				return $comboArray;
			}

			

						
			if ($valChanged > 0) {
				$variances = Variance::where('product_id', $request['productId'])->get();

				foreach ($variances as $variance) {
					$variance->status = "invalid";
					$variance->save();
				}

				$comboArray = makeAddVariance($product, $attributes, $comboArray, $attQ);
				return view('add-variant', ['productId' => $product->id])->with('combos', $comboArray);

			} else {
				return view('edit-product', ['product' => $product, 'attributes' => $attributes]);
			}


		

			//return view('add-attribute', ['productName' => $productName, 'attQ' => $attQ, 'productCategory' => $productCategory]);

		} elseif ($optionChoice == "addAtt") {

			if ($request['addNumber'] != 0) {
				$attQ = $request['addNumber'];
				$n = 0;


				if($product->type == "Simple"){
					$product->type = "Variable";
					$product->save();
				}

				while ($n < $attQ) {
					$newAttribute = new Attribute();
					$product->attributes()->save($newAttribute);
					$n++;
				}

				return view('new-attribute', ['productName' => $productName, 'attQ' => $attQ, 'productId' => $product->id]);
			} else {
				return view('edit-product', ['product' => $product, 'attributes' => $attributes]);
			}

		} elseif ($optionChoice == "priceQ") {

			$variances = Variance::where('product_id', $product->id)->where('status', 'valid')->get();

			$comboArray = array();
			
			foreach ($variances as $variance) {
				array_push($comboArray, $variance->combo);	
			}
			
			return view('edit-variant', ['productId' => $product->id, 'variances' => $variances]);


		} elseif ($optionChoice == "deleteAtt") {
			
			$dAtts = $request['delete'];

			foreach ($dAtts as $key => $dAtt) {
				foreach ($attributes as $key => $attribute) {
					if($attribute->id == $dAtt) {
						Attribute::destroy($attribute->id);
					}
				}
			}

			//$attQ = count($attributes) - count($dAtts);
			//dd($attQ);
			//return view('new-attribute', ['productName' => $productName, 'attQ' => $attQ, 'productId' => $product->id]);


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

			$attributes = Attribute::where('product_id', $request['productId'])->get();

			$variances = Variance::where('product_id', $request['productId'])->get();

				foreach ($variances as $variance) {
					$variance->status = "invalid";
					$variance->save();
				}

			$attQ = count($attributes);

				$comboArray = makeAddVariance($product, $attributes, $comboArray, $attQ);

				return view('add-variant', ['productId' => $product->id])->with('combos', $comboArray);


		} elseif ($optionChoice == "deletePro") {

			$pic = Product::where('id', $product->id)->first();

			if ($pic->pic !== 'default.jpg') {
					$path = 'uploads/products/' . $pic->pic;
					\File::delete($path);
				}

			$images = Variance::where('product_id', $product->id)->get();

			foreach ($images as $key => $image) {
				if ($image->image !== 'default.jpg') {
					$path = 'uploads/products/' . $image->image;
					\File::delete($path);
				}
			}

			$ddel = Detail::where('product_id', $product->id)->delete();

			$vdel = Variance::where('product_id', $product->id)->delete();
			//$vdel->destroy();

			$adel = Attribute::where('product_id', $product->id)->delete();
			//$adel->destroy();

			$pdel = Product::where('id', $product->id)->delete();
			//$pdel->destroy();

			return view('home', ['productAdded' => "Product and it's Variance has been DELETED"]);

		} elseif ($optionChoice == "nothing") {
			return view('edit-product', ['product' => $product, 'attributes' => $attributes]);
		}

	}



	public function postMoreAttribute (Request $request) 
	{
		$newAttributes = Attribute::where('product_id', $request['productId'])->where('name', NULL)->where('value', NULL)->get();

		foreach ($newAttributes as $count=>$attribute) {
			$attribute->name = $request['name'.$count];
			$attribute->value = $request['value'.$count];
			$attribute->save();
		}

		$product = Product::where('id', $request['productId'])->first();

		$attributes = Attribute::where('product_id', $request['productId'])->get();

		$attQ = count($attributes);


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
						} else {
					$combo = implode(", ", $combo);
					array_push($comboArray, $combo);
					$variance = new Variance();
					$variance->combo = $combo;
					$product->variances()->save($variance);
				}
			} 
			
			return $comboArray;
		}

		

					
		
			$variances = Variance::where('product_id', $request['productId'])->get();

			foreach ($variances as $variance) {
				$variance->status = "invalid";
				$variance->save();
			}

			$comboArray = makeAddVariance($product, $attributes, $comboArray, $attQ);
			return view('add-variant', ['productId' => $product->id])->with('combos', $comboArray);

			
	}


	public function deleteAttribute (Request $request)
	{
		
	}
}