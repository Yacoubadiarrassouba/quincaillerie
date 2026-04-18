<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request; // Cette ligne doit être présente

class AdminController extends Controller
{
    // Ajoute bien (Request $request) ici :
    public function index(Request $request)
    {
        $categories = Category::all();

        // On commence la requête
        $query = Product::with('category', 'prices');

        // Maintenant $request est reconnu !
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();

        return view('admin.index', compact('products', 'categories'));
    }
}
