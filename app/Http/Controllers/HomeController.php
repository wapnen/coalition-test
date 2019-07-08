<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        $products = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
        return view('welcome', compact('products'));
    }
}
