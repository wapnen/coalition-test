<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
        $products = array_reverse($products);
        return response()->json($products);


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

        $products = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];

        $product = $request->only(['name', 'quantity', 'price']);

        $product['datetime_submitted'] = date('Y-m-d H:i:s');

        $total = $request->quantity * $request->price;

        $product['total'] = $total;

        $product['id'] = count($products) + 1;

        array_push($products,$product);

        Storage::disk('local')->put('data.json', json_encode($products));
        return response()->json(array_reverse($products));
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
        $products = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json'), true) : [];
        $product= array_filter($products,  function($arr) use ($id) {
            return $arr['id'] == $id;
        });
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $request, $id)
    {
        //
        $products = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json'), true) : [];

        foreach ($products as &$product) {
          if ($product["id"] == $id) {
              $product["name"] = $request->name;
              $product['quantity']=  $request->quantity;
              $product["price"] = $request->price;
              $product["total"] = $request->quantity * $request->price;
            }
        }
        Storage::disk('local')->put('data.json', json_encode($products));
        return response()->json(array_reverse($products));
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
