<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->error('Tidak ada kategori ditemukan. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        $products = [
            // Sepatu Futsal
            [
                'name' => 'Futsal Pro Grip',
                'description' => 'Sepatu futsal dengan sol non-slip dan desain modern untuk kontrol bola maksimal di arena dalam ruangan.',
                'price' => 325000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1519741495755-8bb9c9863f00?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Futsal')->first()->id
            ],
            [
                'name' => 'Futsal Turbo Elite',
                'description' => 'Sepatu ringan dengan bantalan empuk dan cengkraman sempurna untuk manuver cepat dan akselerasi tinggi.',
                'price' => 385000,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1552346154-5c1d0907c0bd?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Futsal')->first()->id
            ],
            [
                'name' => 'Futsal Classic Street',
                'description' => 'Desain klasik dengan bahan sintetis premium, ideal untuk pemain futsal yang mengutamakan kenyamanan dan daya tahan.',
                'price' => 295000,
                'stock' => 28,
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Futsal')->first()->id
            ],

            // Sepatu Sepakbola
            [
                'name' => 'Sepatu Bola Sprint',
                'description' => 'Sepatu sepakbola untuk lapangan rumput sintetis dengan cleats kuat dan dukungan pergelangan yang stabil.',
                'price' => 460000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Sepakbola')->first()->id
            ],
            [
                'name' => 'Sepatu Bola Galaxy',
                'description' => 'Model elegan dengan bahan ringan, cocok untuk latihan dan pertandingan di berbagai kondisi lapangan.',
                'price' => 495000,
                'stock' => 16,
                'image' => 'https://images.unsplash.com/photo-1595950653352-1d0a6e5e96f0?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Sepakbola')->first()->id
            ],
            [
                'name' => 'Sepatu Bola Velocity',
                'description' => 'Dirancang untuk kecepatan, memberikan respons instan dan feel bola yang presisi setiap sentuhan.',
                'price' => 520000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Sepakbola')->first()->id
            ],

            // Sepatu Lari
            [
                'name' => 'Running Cloud X',
                'description' => 'Sepatu lari ringan dengan support midsole responsif untuk jarak menengah hingga jarak jauh.',
                'price' => 410000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1528701800489-20c2a269f5f4?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Lari')->first()->id
            ],
            [
                'name' => 'Trail Runner Flex',
                'description' => 'Sepatu lari trail dengan grip kuat dan bahan breathable untuk kenyamanan di medan off-road.',
                'price' => 445000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Lari')->first()->id
            ],
            [
                'name' => 'Speed Run Lite',
                'description' => 'Desain aerodinamis dan cushioning ringan untuk meningkatkan kecepatan saat sprint dan latihan running.',
                'price' => 375000,
                'stock' => 27,
                'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Lari')->first()->id
            ],

            // Sneakers
            [
                'name' => 'Sneakers Urban Motion',
                'description' => 'Sneakers kasual dengan gaya sporty, nyaman dipakai untuk gaya sehari-hari maupun hangout.',
                'price' => 365000,
                'stock' => 42,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sneakers')->first()->id
            ],
            [
                'name' => 'Sneakers Retro Vibe',
                'description' => 'Desain retro modern dengan detail warna yang menarik dan sol empuk untuk kenyamanan maksimal.',
                'price' => 395000,
                'stock' => 33,
                'image' => 'https://images.unsplash.com/photo-1533106418987-4f4c4a558c18?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sneakers')->first()->id
            ],
            [
                'name' => 'Sneakers Street Edge',
                'description' => 'Sneakers premium untuk tampilan urban, cocok untuk gaya santai dan aktivitas ringan.',
                'price' => 430000,
                'stock' => 26,
                'image' => 'https://images.unsplash.com/photo-1528701800489-20c2a269f5f4?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sneakers')->first()->id
            ],
            
            // Tambahan Sepatu Futsal
            [
                'name' => 'Futsal Lighspeed Reborn',
                'description' => 'Sepatu futsal lighspeed reborn kualitas premium memberikan rasa nyaman dan kontrol bola sempurna.',
                'price' => 350000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Futsal')->first()->id
            ],
            [
                'name' => 'Futsal Master Control',
                'description' => 'Desain khusus untuk kontrol bola tinggi dengan teknologi grip terbaru di kelasnya.',
                'price' => 405000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1519741495755-8bb9c9863f00?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Futsal')->first()->id
            ],
            
            // Tambahan Sepatu Sepakbola
            [
                'name' => 'Sepatu Bola Thunder Strike',
                'description' => 'Untuk pemain yang mengandalkan tendangan akurat dan power shooting di setiap kesempatan.',
                'price' => 485000,
                'stock' => 19,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Sepakbola')->first()->id
            ],
            [
                'name' => 'Sepatu Bola Dynamic Pro',
                'description' => 'Teknologi dinamis untuk adaptasi cepat terhadap berbagai medan lapangan pertandingan.',
                'price' => 510000,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1595950653352-1d0a6e5e96f0?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Sepakbola')->first()->id
            ],
            
            // Tambahan Sepatu Lari
            [
                'name' => 'Running Marathon Elite',
                'description' => 'Sepatu marathon profesional dengan cushioning endurance untuk jarak sangat jauh.',
                'price' => 470000,
                'stock' => 17,
                'image' => 'https://images.unsplash.com/photo-1528701800489-20c2a269f5f4?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Lari')->first()->id
            ],
            [
                'name' => 'Running Sprint Power',
                'description' => 'Dirancang untuk pelari sprint dengan response cepat dan propulsion maksimal setiap langkah.',
                'price' => 425000,
                'stock' => 23,
                'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sepatu Lari')->first()->id
            ],
            
            // Tambahan Sneakers
            [
                'name' => 'Sneakers Classic Comfort',
                'description' => 'Sneakers klasik dengan perpaduan gaya vintage dan kenyamanan modern untuk penggunaan sehari-hari.',
                'price' => 380000,
                'stock' => 38,
                'image' => 'https://images.unsplash.com/photo-1533106418987-4f4c4a558c18?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sneakers')->first()->id
            ],
            [
                'name' => 'Sneakers Bold Statement',
                'description' => 'Sneakers berani dengan warna mencolok dan design statement untuk tampil percaya diri.',
                'price' => 415000,
                'stock' => 31,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories->where('name', 'Sneakers')->first()->id
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Berhasil menambahkan ' . count($products) . ' produk contoh.');
    }
}