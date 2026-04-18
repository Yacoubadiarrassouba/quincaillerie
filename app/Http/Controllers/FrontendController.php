<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        // On récupère le mot-clé de recherche
        $search = $request->input('search');

        // On charge les catégories ET leurs produits filtrés
        // C'est ici qu'on applique la recherche
        $categories = Category::with(['products' => function($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            // On limite à 12 produits par catégorie pour la page d'accueil
            $query->latest();
        }])->get();

        // On récupère aussi une liste globale pour la pagination si nécessaire
        // (Optionnel selon comment tu veux afficher tes résultats)
        $products = Product::latest();
        if ($search) {
            $products->where('name', 'like', '%' . $search . '%');
        }

        $products = $products->paginate(12);

        return view('frontend.home', compact('categories', 'products'));
    }
}
