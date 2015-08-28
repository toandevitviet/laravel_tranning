<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//call model to use
use App\Model\Products;

//call Session + Input + Validator
use Session;
use Input;
use Validator;

//call DB
use DB;

//validate form submit
use Illuminate\Foundation\Http\FormRequest;


class productCurd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Add new product from form post value.
     *
     * @param  input  $product_name, $product_price, $product_description
     * @return Response
     */
    public function saveProduct(Request $request)
    {
        $product = new Products();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');

        //upload product_image
        $file = array('product_image' => Input::file('product_image')); 
        $rules_image = array('product_image'=>'required');
        $validator = Validator::make($file, $rules_image);
        $url_file = "";
        if ($validator->fails()) {
            //error
        } else {
        if (Input::file('product_image')->isValid()) {
            $destinationPath = 'uploads'; // upload path
            $extension = Input::file('product_image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(1,999999).'.'.$extension; // renameing image
            Input::file('product_image')->move($destinationPath, $fileName); // uploading file to given path
            $url_file  = $destinationPath . '/' . $fileName;
            // sending back with message
        } else {
              // sending back with error message.
            }
        }
        $product->product_image = $url_file;

        //validation form
        $rules = array(
            'product_name'             => 'required',                        // just a normal required validation
            'product_price'            => 'required|numeric',     // required and must be unique in the ducks table
            'product_description' => 'required'           // required and has to match the password field
        );
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();
            // redirect our user back to the form with the errors from the validator
            return redirect('/')->withErrors($validator);

        } else {
            //save product into database
            $product->save();
            Session::flash('message', 'Product was created!');
            return redirect('/');
        }
    }

    /**
     * Display get all products
     *
     * @return Response
     */
    public function products() 
    {
        //get model and list data

        //remove function all -> pagination
        /*$products = Products::all();
        return view('catalog/products')->with('products', $products);*/

        $function = new \ReflectionClass('DB');
        $products = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->paginate(config('products.products_per_page'));
        $products->setPath(url('/products'));
        
        return view('catalog/products', ['products' => $products]);

    }

    /**
     * Delete product int $id
     *
     * @return Response
     */
    public function delete($id)
    {
        Products::find($id)->delete();
        Session::flash('message', "Product id $id was deleted!");
        return redirect('/products');
    }

    /**
     * Edit product int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Products::whereId($id)->firstOrFail();
        
        return view('catalog.edit', ['product' => $product]);
    }

    /**
     * Update product int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $product = Products::findOrFail($id);
        //get all request -> need add fillable in model / lack token
        
        //not get input all
        //$input = $request->all();

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');

        //upload product_image
        $file = array('product_image' => Input::file('product_image')); 
        $rules = array('product_image'=>'required');
        $validator = Validator::make($file, $rules);
        $url_file = "";
        if ($validator->fails()) {
            //error
        } else {
        if (Input::file('product_image')->isValid()) {
            $destinationPath = 'uploads'; // upload path
            $extension = Input::file('product_image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(1,999999).'.'.$extension; // renameing image
            Input::file('product_image')->move($destinationPath, $fileName); // uploading file to given path
            $url_file  = $destinationPath . '/' . $fileName;
            // sending back with message
        } else {
              // sending back with error message.
            }
        }

        //get product current before update
        $product_before = DB::table('products')->where('id', '=', $id)->get();

        //check upload new image
        if(strlen($url_file) > 0 ) {
            //upload new file
            $product->product_image = $url_file;
        } else {
            $product->product_image = $product_before[0]->product_image;
        }        

        //not use input all
        //$product->fill($input)->save();

        //validation form
        $rules = array(
            'product_name'             => 'required',        // just a normal required validation
            'product_price'            => 'required|numeric',     // required and must be required and number only
            'product_description' => 'required'           // just a normal required validation
        );
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();
            // redirect our user back to the form with the errors from the validator
            return redirect("/edit/$id")->withErrors($validator);

        } else {
            //save product into database
            $product->save();

            Session::flash('message', 'Product was updated!');
            return redirect()->back();
        }
    }

    /**
     * show product int id
     *
     * @return Response
     */
    public function showProduct($id)
    {
        $product = Products::whereId($id)->firstOrFail();
        return view('catalog/item', ['product' => $product]);
    }

    /**
     * search function
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $value = $request->input('txtkeyword');
        $products = DB::table('products')->where('product_name', 'LIKE', '%' . $value . '%')->paginate(config('products.products_per_page'));
        Session::flash('message', "Have " .count($products). " value with keyword '" .$value. "' ");  
        return view('catalog/products', compact('products', 'products'));
    }
}
