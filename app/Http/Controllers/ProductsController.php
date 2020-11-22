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

    public function edit(Request $request)
    {
        $product = Product::find($request->id);
        if($product) {
            return view('admin.products.edit', ['product' => $product]);
        }
        return redirect()->route('productList');
    }

    public function updateAjax(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price'=>'required',
            'description' => 'required'
        ]);

        $data = $request->all();
        unset($data['_token']);
        if(isset($data['image_url'][0])) {
            $data['image_url'] = $data['image_url'][0];
        } else {
            unset($data['image_url']);
        }

        $result = Product::whereId($data['id'])->update($data) ? true : false;
        return response()->json(['success'=>$result, 'message'=>$result?'Success':'Fail']);
    }

    public function deleteAjax(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            if(Product::destroy($request->id)) {
                return response()->json(['success'=>true, 'message'=>'Success']);
            }
            else {
                return response('Error Delete', 400);
            }
        }
        else {
            return response('Product Not Found', 404);
        }

        //$result = Product::whereId($data['id'])->update($data) ? true : false;
        //return response()->json(['success'=>$result, 'message'=>$result?'Success':'Fail']);
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
