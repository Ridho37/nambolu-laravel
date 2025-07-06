<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $request['slug'] = \Illuminate\Support\Str::slug($request['name']);

        $postData = [
            'name'          => $request->name,
            'description'   => $request->description,
            'slug'          => $request['slug']
        ];
        
        Category::create($postData);
        return redirect('/admin/dashboard/categories')->with(['message' => 'Data kategori berhasil ditambah!', 'status'=>'success']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('success', 'Kategori berhasil dihapus');
    }
}
