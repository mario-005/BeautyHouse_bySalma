<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Biore UV Aqua Rich Sunscreen',
                'category' => 'Sunscreen',
                'price' => 115000.00,
                'stock' => 50,
                'description' => 'Sunscreen bertekstur air yang sangat ringan dengan perlindungan SPF 50+ PA++++. Tidak lengket dan cepat meresap.',
                'image' => null,
            ],
            [
                'name' => 'Azarine Hydrasoothe Sunscreen Gel',
                'category' => 'Sunscreen',
                'price' => 65000.00,
                'stock' => 75,
                'description' => 'Sunscreen gel ringan tanpa alkohol dan silikon. Sangat cocok untuk kulit berminyak dan berjerawat.',
                'image' => null,
            ],
            [
                'name' => 'COSRX Good Morning Gel Cleanser',
                'category' => 'Face Wash',
                'price' => 125000.00,
                'stock' => 30,
                'description' => 'Pembersih gel lembut yang diformulasikan dengan tea tree oil dan BHA alami untuk menghaluskan tekstur kulit.',
                'image' => null,
            ],
            [
                'name' => 'Senka Perfect Whip Face Wash',
                'category' => 'Face Wash',
                'price' => 55000.00,
                'stock' => 60,
                'description' => 'Sabun cuci muka dengan busa melimpah dan padat yang membersihkan kulit hingga ke pori-pori.',
                'image' => null,
            ],
            [
                'name' => 'St. Ives Fresh Skin Apricot Scrub',
                'category' => 'Scrub',
                'price' => 85000.00,
                'stock' => 40,
                'description' => 'Scrub wajah dengan 100% eksfolian alami dari ekstrak aprikot. Mengangkat sel kulit mati untuk kulit lebih cerah.',
                'image' => null,
            ],
            [
                'name' => 'Somethinc Niacinamide Serum',
                'category' => 'Serum',
                'price' => 89000.00,
                'stock' => 40,
                'description' => 'Serum niacinamide 10% untuk meratakan warna kulit, mengecilkan pori, dan mengontrol produksi minyak berlebih.',
                'image' => null,
            ],
            [
                'name' => 'Avoskin Miraculous Refining Serum',
                'category' => 'Serum',
                'price' => 240000.00,
                'stock' => 20,
                'description' => 'Chemical exfoliating serum yang mengandung AHA BHA PHA untuk mengatasi jerawat dan komedo.',
                'image' => null,
            ],
            [
                'name' => 'Salma Signature Silk Scarf',
                'category' => 'Fashion',
                'price' => 135000.00,
                'stock' => 20,
                'description' => 'Syal sutra premium dengan motif bunga elegan dalam warna-warna cerah. Bahan lembut dan breathable, cocok dipakai seharian.',
                'image' => null,
            ],
            [
                'name' => 'Tote Bag Canvas Premium',
                'category' => 'Fashion',
                'price' => 175000.00,
                'stock' => 18,
                'description' => 'Tas tote dari canvas tebal berkualitas tinggi dengan tali kulit sintetis. Kapasitas besar, cocok untuk kuliah maupun jalan-jalan.',
                'image' => null,
            ],
            [
                'name' => 'Oversized Linen Shirt',
                'category' => 'Fashion',
                'price' => 245000.00,
                'stock' => 12,
                'description' => 'Kemeja linen oversize dengan potongan modern. Material adem dan breathable, tersedia dalam pilihan warna netral yang mudah dipadukan.',
                'image' => null,
            ],
            [
                'name' => 'Bucket Hat Streetwear',
                'category' => 'Fashion',
                'price' => 95000.00,
                'stock' => 35,
                'description' => 'Bucket hat gaya streetwear dari bahan drill yang kuat namun ringan. Cocok untuk aktivitas outdoor maupun hangout kasual.',
                'image' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
