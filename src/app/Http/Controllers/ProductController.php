<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->appends($request->only(['keyword', 'sort']));

        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('products.update', compact('product', 'seasons'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images/products', $fileName);
            $product->image = $fileName;
        }

        $product->save();

        $product->seasons()->sync($validated['seasons'] ?? []);

        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($productId);
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images/products', $fileName);
            $product->image = $fileName;
        }

        $product->save();

        $product->seasons()->sync($validated['seasons'] ?? []);

        return redirect()->route('products.index')->with('success', '商品を更新しました。');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}
