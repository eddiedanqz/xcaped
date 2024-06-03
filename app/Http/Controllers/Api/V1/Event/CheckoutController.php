<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        // $userId = auth()->user()->id;
        // $oldCartItems = Cart::where('user_id',$userId)->get();
        // foreach ($oldCartItems as $item)
        //  {
        //     //Check stock management
        //     if(!Product::where('id',$item->product_id)->where('quantity','>=',$item->quantity)->exists())
        //     {
        //        $removeItem = Cart::where('user_id',$userId)->where('product_id',$item->product_id)->first();
        //        $removeItem->delete();
        //     }
        // }

        //get tickets with quantity
        $tickets = $request->all();

        $response =  [
         'products' => $tickets,
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
        //
    }
}
