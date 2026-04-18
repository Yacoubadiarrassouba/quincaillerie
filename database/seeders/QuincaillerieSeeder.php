<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice; // <-- Change ici (on utilise ProductPrice au lieu de Price)

class QuincaillerieSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer une Catégorie
        $elec = Category::create(['name' => 'Électricité']);

        // 2. Créer un Produit dans cette catégorie
        $ampoule = Product::create([
            'category_id' => $elec->id,
            'name' => 'Ampoule LED',
            'image' => 'Unknown.jpeg'
        ]);

        // 3. Utiliser ProductPrice au lieu de Price
        ProductPrice::create(['product_id' => $ampoule->id, 'price' => 430]);
        ProductPrice::create(['product_id' => $ampoule->id, 'price' => 930]);
        ProductPrice::create(['product_id' => $ampoule->id, 'price' => 2000]);

        // Ajout d'une deuxième catégorie
        $peinture = Category::create(['name' => 'Peinture']);
        $pot = Product::create([
            'category_id' => $peinture->id,
            'name' => 'Pot de peinture Deluxi',
            'image' => 'pot de peinture deluxi.jpeg'
        ]);
        ProductPrice::create(['product_id' => $pot->id, 'price' => 23500]);
    }
}
