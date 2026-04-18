<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Afficher le formulaire de création
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Enregistrer le produit dans la base de données
    public function store(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prices' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        // 2. Gestion de l'image
        $imageName = null;
        if ($request->hasFile('image')) {
            // On stocke l'image dans le dossier 'public/products'
            $imagePath = $request->file('image')->store('products', 'public');
            // On ne garde que le nom du fichier pour la base de données
            $imageName = basename($imagePath);
        }

        // 3. Création du Produit
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);

        // 4. Gestion des prix multiples
        // On transforme la chaîne "400, 800" en tableau [400, 800]
        $prices = explode(',', $request->prices);

        foreach ($prices as $priceValue) {
            ProductPrice::create([
                'product_id' => $product->id,
                'price' => trim($priceValue) // trim enlève les espaces vides
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Produit ajouté avec succès !');
    }

    // Afficher le formulaire de modification
    public function edit(Product $product)
    {
        $categories = Category::all();
        // On prépare les prix sous forme de chaîne "400, 800" pour le formulaire
        $pricesString = $product->prices->pluck('price')->implode(', ');

        return view('admin.products.edit', compact('product', 'categories', 'pricesString'));
    }

    // Mettre à jour le produit
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prices' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = basename($imagePath);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $product->image
        ]);

        // Mise à jour des prix : on supprime les anciens et on recrée les nouveaux
        $product->prices()->delete();
        $prices = explode(',', $request->prices);
        foreach ($prices as $priceValue) {
            ProductPrice::create([
                'product_id' => $product->id,
                'price' => trim($priceValue)
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Produit mis à jour !');
    }

    // Supprimer le produit
    public function destroy(Product $product)
    {
        // Supprimer l'image du disque
        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        // La suppression des prix est automatique grâce au "onDelete('cascade')" dans ta migration
        $product->delete();

        return redirect()->route('admin.index')->with('success', 'Produit supprimé !');
    }
}
