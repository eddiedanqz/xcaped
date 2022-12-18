<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $products = Cart::where('user_id',$userId)->get();

        $response =  [
            'products' => $products,
          ];

          return response($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId= auth()->user()->id;
        $data = $request->all();
        $data['user_id'] = $userId;

        $duplicate = Cart::where('user_id',$userId)->where('product_id',$request['product_id'])->exists();

        //
        if($duplicate){
         return response(['message' => 'Already exists in cart'], 409);
        }

        $product = Cart::create($data);

        $response =  [
          'message' => 'Added to cart',
        ];

        return response($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user();
        $product = Cart::find($id);
        // delete the user
        $product->delete();

        return ['message' => 'Removed from cart'];
    }
}
