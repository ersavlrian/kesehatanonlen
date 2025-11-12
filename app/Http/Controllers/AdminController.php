<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function Category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }
    public function postCategory(Request $request){
         $request->validate([
            'category' => 'required|string|max:255',
        ]);
        $category = new Category();
        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category Added Succesfully');
    }

    public function deleteCategory($id)
{
    $category=Category::findOrFail($id);

    if ($category) {
        $category->delete();
        return redirect()->back()->with('category_message', 'Kategori berhasil dihapus!');
    }

    return redirect()->back()->with('category_message', 'Kategori tidak ditemukan.');
}

    public function updateCategory(Request $request, $id){
       $category=Category::findOrFail($id);
       $category->category=$request->category;
       $category->save();
       return redirect()->back()->with('categoryupdate_message','Category Update Succesfully');
    }

    public function product(){
        $categories = Category::all();
         $products = Product::with('category')->paginate(5);
    return view('admin.product', compact('categories','products'));
    }

    public function addProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'image' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
        'description' => $request->description,
    ]);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}

public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|max:2048', 
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        $product->save();
        
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }


}
