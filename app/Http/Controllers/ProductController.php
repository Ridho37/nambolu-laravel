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
    // app/Http/Controllers/ProductController.php

    public function index()
    {
        $categories = Category::all();
        // Pastikan baris di bawah ini menggunakan paginate()
        $products = Product::latest()->filter(request(['search', 'category']))->paginate(9); 
        $title = 'All Products';

        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Products in ' . $category->name;
        }

        return view('products.index', [
            'title' => $title,
            'products' => $products,
            'categories' => $categories
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Perintah ini menyimpan file ke folder 'products' di dalam storage/app/public
            // dan secara otomatis mengembalikan path lengkapnya (contoh: 'products/namafile.jpg')
            $path = $request->file('image')->store('products', 'public');

            // dd($path);

            // Simpan path lengkap tersebut ke database
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']) . '-' . uniqid();

        Product::create($validatedData);

        return redirect()->route('products')->with('success', 'Data produk berhasil ditambahkan!');
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