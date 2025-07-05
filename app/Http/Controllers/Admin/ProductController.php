<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $products = \App\Models\Product::latest()->with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di pilihan dropdown
        $categories = \App\Models\Category::all();

        // Tampilkan view form create dan kirim data kategori
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // 2. Handle Upload Gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $validatedData['image'] = 'products/' . $imageName;
        }

        // 3. Buat slug dari nama produk
        $validatedData['slug'] = \Illuminate\Support\Str::slug($request->name);

        // 4. Simpan data ke database
        \App\Models\Product::create($validatedData);

        // 5. Redirect kembali ke halaman daftar produk dengan pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validasi data
        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
        
        $validatedData = $request->validate($rules);

        // 2. Siapkan data untuk di-update, dimulai dengan data tervalidasi
        $updateData = $validatedData;

        // 3. Jika nama berubah, update juga slug-nya
        if ($request->name != $product->name) {
            $updateData['slug'] = Str::slug($request->name);
        }

        // 4. Cek jika ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && File::exists(public_path('images/' . $product->image))) {
                File::delete(public_path('images/' . $product->image));
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $updateData['image'] = 'products/' . $imageName;
        }

        // 5. Update data produk di database menggunakan data yang sudah disiapkan
        $product->update($updateData);

        // 6. Redirect kembali
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // 1. Hapus gambar produk dari folder public jika ada
        if ($product->image && \Illuminate\Support\Facades\File::exists(public_path('images/' . $product->image))) {
            \Illuminate\Support\Facades\File::delete(public_path('images/' . $product->image));
        }

        // 2. Hapus data produk dari database
        $product->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
        }
}
