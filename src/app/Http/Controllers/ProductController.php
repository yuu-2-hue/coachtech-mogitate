<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\DetailRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Product;
use App\Models\Season;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 商品一覧画面
    public function index()
    {
        $products = Product::Paginate(6);
        return view('product', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::with('seasons')->KeywordSearch($request->keyword)->paginate(6);
        return view('product', compact('products'));
    }

    // 詳細画面
    public function detail($productId)
    {
        $product = Product::find($productId);
        $seasons = Season::All();
        return view('detail', compact('product', 'seasons'));
    }

    public function edit(DetailRequest $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/img', $file_name);
        // ProductSeasonTableの更新
        $data = [];
        for($i = 0; $i < count($request->season); $i++)
        {
            array_push($data, $request->season[$i]);
        }
        Product::Find($request->id)->seasons()->sync($data);
        // ProductTableの更新
        Product::Find($request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'img/'.$file_name,
            'description' => $request->description,
        ]);

        return redirect('/products');
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        Storage::disk('public')->delete($product->image);

        Product::find($request->id)->delete();
        return redirect('/products');
    }

    // 商品登録画面
    public function register()
    {
        $seasons = Season::All();
        return view('register', compact('seasons'));
    }

    public function add(RegisterRequest $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/img', $file_name);

        // ProductTableの更新
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'img/'.$file_name,
            'description' => $request->description,
        ]);

        // ProductSeasonTableの更新
        $data = [];
        for($i = 0; $i < count($request->season); $i++)
        {
            array_push($data, $request->season[$i]);
        }
        $post = Product::orderBy('id', 'desc')->first();
        Product::Find($post->id)->seasons()->sync($data);

        return redirect('/products');
    }

}
