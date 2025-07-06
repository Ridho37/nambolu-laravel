<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // Hanya mengambil semua produk dan mengirimnya ke view
        $products = Product::latest()->get();
        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('dashboard.dashboard-create', ['categories' => $categories]);
    }

    // proses simpan data
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'price'         => 'required|integer|min:0',
            'stock'         => 'required|integer|min:0',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageName = time().'.'.$imageFile->extension();
            $destinationPath = storage_path('app/public/products');
            $imageFile->move($destinationPath, $imageName);
            // $imageFile->storeAs('app/public/products', $imageName);
            $validateData['image'] = $imageName;
        }
        $validateData['slug'] = \Illuminate\Support\Str::slug($validateData['name']);

        Product::create($validateData);
        return redirect('/admin/dashboard/products')->with(['message' => 'Data produk berhasil ditambah!', 'status'=>'success']);
    }

    // mengarahkan ke edit
    public function edit(Product $product){
        $categories = Category::orderBy('name','asc')->get();

        return view('dashboard.dashboard-edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // 1. Validasi Data
        $rules = [
            'name'        => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validatedData = $request->validate($rules);

        // 2. Logika untuk Upload Gambar Baru (jika ada)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            // Simpan gambar baru
            $imageName = time() . '.' . $request->file('image')->extension();
            $destinationPath = storage_path('app/public/products');
            $request->file('image')->move($destinationPath, $imageName);

            $validatedData['image'] = $imageName;
        }

        $validatedData['slug'] = Str::slug($validatedData['name'], '-');

        $product->update($validatedData);

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }
        $product->delete();
        return redirect()->route('products')->with('success', 'Produk berhasil dihapus.');
    }

}