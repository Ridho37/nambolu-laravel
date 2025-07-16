<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Menampilkan semua produk untuk user
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();

        $title = 'Semua Produk';
        if ($request->filled('category')) {
            $category = Category::firstWhere('slug', $request->category);
            if ($category) {
                $title = 'Produk dalam kategori: ' . $category->name;
            }
        }

        return view('products.index', [
            'title' => $title,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    // Detail produk
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    // Form tambah produk (admin)
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('dashboard.dashboard-create', ['categories' => $categories]);
    }

    // Proses simpan produk baru (admin)
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
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . uniqid();
        $product = Product::create($validatedData);

        AdminLog::create([
            'action' => 'Tambah Produk',
            'description' => 'Menambahkan produk <strong>' . $product->name . '</strong>',
            'admin_name' => auth()->user()->name
        ]);

        return redirect()->route('products')->with('success', 'Data produk berhasil ditambahkan!');
    }

    // Form edit produk (admin)
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('dashboard.dashboard-edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // Proses update produk (admin)
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name'        => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . uniqid();

        // Catat perubahan field
        $changes = [];
        foreach ($validatedData as $key => $newValue) {
            $oldValue = $product->getOriginal($key);
            if ($oldValue != $newValue && $key !== 'slug') {
                $changes[] = ucfirst($key) . ": '" . $oldValue . "' → '" . $newValue . "'";
            }
        }

        $product->update($validatedData);

        // Format deskripsi aktivitas jadi lebih rapi
        $description = '';
        if (!empty($changes)) {
            $description .= '<ul class="list-disc list-inside mt-1">';
            foreach ($changes as $change) {
                $description .= "<li>{$change}</li>";
            }
            $description .= '</ul>';
        }

        AdminLog::create([
            'action' => 'Ubah Produk: ' . $product->name,
            'description' => $description,
            'admin_name' => auth()->user()->name
        ]);

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui!');
    }


    // Proses hapus produk (admin)
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $productName = $product->name;
        $product->delete();

        AdminLog::create([
            'action' => 'Hapus Produk',
            'description' => 'Menghapus produk <strong>' . $productName . '</strong>',
            'admin_name' => auth()->user()->name ?? 'Admin'
        ]);

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus.');
    }
}
