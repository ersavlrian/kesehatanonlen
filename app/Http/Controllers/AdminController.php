<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

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



}
