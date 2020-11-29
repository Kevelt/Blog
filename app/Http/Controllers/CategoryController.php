<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories'=>$categories]);
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.categories.create', ['products'=>$products]);
    }

    public function createAjax(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'products' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        //Product::create($data);
        return response()->json(['success'=>true, 'message'=>'Success', 'data'=>$data]);
    }
}
