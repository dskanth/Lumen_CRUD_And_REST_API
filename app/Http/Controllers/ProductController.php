<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends BaseController
{
    public function index(){ //Get all records from products table
    	return Product::orderBy('id','desc')->get();
    }

    public function show($id){ //Get a single record by ID
    	return Product::find($id); 
    }

    public function store(Request $request){ //Insert new record to products table
    	$this->validate($request, [
	        'name'			=> 'required',
	        'description'	=> 'required'
	    ]);
		
		$product 				= new Product;
		$product->name 			= $request->input('name');
		$product->description 	= $request->input('description');
		$product->save();
		//$product_arr = array('id'=>$product->id, 'name'=>$request->input('name'), 'desc'=>$request->input('description'), 'created_at'=>$product->created_at, 'updated_at'=>$product->updated_at);
		//return json_encode($product_arr); //'Success adding new product';
		return json_encode($product);
	}

    public function update(Request $request, $id){ //Update a record
    	$this->validate($request, [
	        'name'			=> 'required',
	        'description'	=> 'required',
	    ]);
		$product = Product::find($id);
		$product->name 			= $request->input('name');
		$product->description 	= $request->input('description');
		$product->save();
		//$product_arr = array('id'=>$id, 'name'=>$request->input('name'), 'desc'=>$request->input('description'), 'created_at'=>$product->created_at, 'updated_at'=>$product->updated_at);
		//return json_encode($product_arr);
		//"Sucess updating product #" . $product->id;
		return json_encode($product);
	}

    public function destroy(Request $request){ //Delete a record
    	$this->validate($request, [
	        'id' => 'required|exists:products'
	    ]);
		$product = Product::find($request->input('id'));
		$product->delete();
		return "Success deleting product #".$request->input('id');
    }
}
