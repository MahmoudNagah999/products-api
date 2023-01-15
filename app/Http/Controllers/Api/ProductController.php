<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use GrahamCampbell\ResultType\Success;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'products list',
            'data' => $products
        ]);
    }

    // public function store (Request $request)
    // {
    //     $input = $request::all();
    //     $validator = Validator::make($input, [
    //         'name' => 'required',
    //         'detail' => 'required',
    //         'price' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', Validator->errors());
    //     }

    //     $product = Product::create($input);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'product create successfully',
    //         'data' => $product
    //     ]);

    // }

    public function store (Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required'
        ]);

        $product = Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'product create successfully',
            'data' => $product
        ]);

    }


    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError("product Not Find");
        }

        return response()->json([
            'success' => true,
            'message' => 'product retrived successfully',
            'data' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $input = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required'
        ]);

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->price = $input['price'];
        $product->save();

        return response()->json([
            'success'=> true,
            'message'=> 'product updated successfully',
            'data' => $product
        ]);
    }


    // public function update(Request $request, Product $product)
    // {
    //     $input = $request::all();
    //     $validator = Validator::make($input, [
    //         'name'=> 'required',
    //         'detail' => 'required',
    //         'price' => 'required'
    //     ]);

    //     if ($validator->failes()) {
    //         return $this->sendError('Validation Error', $validator->errors());
    //     }

    //     $product->name = $input['name'];
    //     $product->detail = $input['detail'];
    //     $product->price = $input['price'];
    //     $product->save();

    //     return response()->json([
    //         'success'=> true,
    //         'message'=> 'product updated successfully',
    //         'data' => $product
    //     ]);
    // }


    public function destroy (Product $product)
    {
        $product->delete();
        return response()->json([
            'success' => true,
            'message' => 'product deleted successfully',
            'data'=> $product
        ]);
    }



}
