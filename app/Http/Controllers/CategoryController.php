<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        /*
        $products = (Auth::user()->rol == 1)
        ? Category::all()
        : Category::where('user_id', Auth::user()->user)->get();
        return view('admin.categories.index', ['categories'=>$categories]);
        */
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function createAjax(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['image_url'] = $data['image_url'][0];
        Product::create($data);
        return response()->json(['success'=>true, 'message'=>'Success']);
    }
}
