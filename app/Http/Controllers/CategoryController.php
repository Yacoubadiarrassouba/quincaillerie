<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories|max:255']);
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Vérifier si la catégorie contient des produits avant de supprimer
        if($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer : cette catégorie contient des articles !');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée.');
    }
}
