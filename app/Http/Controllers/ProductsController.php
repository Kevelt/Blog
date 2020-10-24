<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = (Auth::user()->rol == 1)
        ? Product::all()
        : Product::where('user_id', Auth::user()->user)->get();
        return view('admin.products.index', ['products'=>$products]);

        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAjax(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price'=>'required',
            'description' => 'required',
            'image_url' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['image_url'] = $data['image_url'][0];
        Product::create($data);
        return response()->json(['success'=>true, 'message'=>'Success']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('product');
    }

}
