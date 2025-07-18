<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DateTime;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //truncate database trước để mỗi lần chạy seeder không bị duplicate dữ liệu
        //tắt ràng buộc fk
        Schema::disableForeignKeyConstraints();
        // xóa dữ liệu bảng restaurants
        DB::table('restaurants')->truncate();
        //bật lại ràng buộc fk
        Schema::enableForeignKeyConstraints();

        $restaurant = [
            // Tokyo restaurants (prefecture_id = 11)
            [
                'restaurant_name' => 'Sukiyabashi Jiro Sushi',
                'description' => 'World famous sushi restaurant with 3 Michelin stars located in Ginza',
                'address' => 'B1F Tsukamoto Sogyo Building, 4-2-15 Ginza, Chuo City, Tokyo',
                'prefecture_id' => 11,
                'contact' => '+81-3-3535-3600',
                'price' => 50.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Narisawa French Restaurant',
                'description' => 'Innovative French-Japanese fusion restaurant with modern kaiseki approach',
                'address' => '2-6-15 Minami-Aoyama, Minato City, Tokyo',
                'prefecture_id' => 11,
                'contact' => '+81-3-5785-0799',
                'price' => 45.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Ippudo Ramen Shibuya',
                'description' => 'Famous tonkotsu ramen chain from Fukuoka serving rich pork bone broth',
                'address' => '1-13-7 Shibuya, Shibuya City, Tokyo',
                'prefecture_id' => 11,
                'contact' => '+81-3-3463-4200',
                'price' => 1.50,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Tempura Kondo',
                'description' => 'High-end tempura restaurant known for vegetable tempura and premium ingredients',
                'address' => '9F Sakaguchi Building, 5-5-13 Ginza, Chuo City, Tokyo',
                'prefecture_id' => 11,
                'contact' => '+81-3-5568-0923',
                'price' => 25.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Osaka restaurants (prefecture_id = 25)
            [
                'restaurant_name' => 'Mizuno Okonomiyaki',
                'description' => 'Traditional okonomiyaki restaurant since 1945 in Dotonbori district',
                'address' => '1-4-15 Dotonbori, Chuo Ward, Osaka',
                'prefecture_id' => 25,
                'contact' => '+81-6-6212-6360',
                'price' => 1.20,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Daruma Kushikatsu',
                'description' => 'Famous kushikatsu restaurant in Shinsekai, established in 1929',
                'address' => '2-3-9 Shinsekai, Naniwa Ward, Osaka',
                'prefecture_id' => 25,
                'contact' => '+81-6-6645-7056',
                'price' => 2.50,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Takoyaki Juhachiban',
                'description' => 'Popular takoyaki stand serving Osaka-style octopus balls',
                'address' => '1-7-1 Dotonbori, Chuo Ward, Osaka',
                'prefecture_id' => 25,
                'contact' => '+81-6-6211-1118',
                'price' => 0.80,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Kyoto restaurants (prefecture_id = 27)
            [
                'restaurant_name' => 'Kikunoi Kaiseki',
                'description' => '3 Michelin stars traditional kaiseki restaurant established in 1912',
                'address' => '459 Shimokawaracho, Higashiyama Ward, Kyoto',
                'prefecture_id' => 27,
                'contact' => '+81-75-561-0015',
                'price' => 60.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Ganko Sushi Kyoto',
                'description' => 'Traditional sushi restaurant showcasing Kyoto-style preparation',
                'address' => '251 Gionmachi Kitagawa, Higashiyama Ward, Kyoto',
                'prefecture_id' => 27,
                'contact' => '+81-75-525-1129',
                'price' => 18.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Hokkaido restaurants (prefecture_id = 1)
            [
                'restaurant_name' => 'Sapporo Ramen Kyowakoku',
                'description' => 'Famous ramen street in Sapporo featuring miso ramen specialty',
                'address' => 'Susukino, Chuo Ward, Sapporo, Hokkaido',
                'prefecture_id' => 1,
                'contact' => '+81-11-232-1781',
                'price' => 1.80,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Otokozushi Susukino',
                'description' => 'Premium sushi restaurant featuring fresh Hokkaido seafood',
                'address' => '3-6-2 Susukino, Chuo Ward, Sapporo, Hokkaido',
                'prefecture_id' => 1,
                'contact' => '+81-11-531-2117',
                'price' => 22.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Fukuoka restaurants (prefecture_id = 40)
            [
                'restaurant_name' => 'Ichiran Ramen Honten',
                'description' => 'Birthplace of famous tonkotsu ramen chain with original recipe',
                'address' => '5-3-2 Nanokawa, Minami Ward, Fukuoka',
                'prefecture_id' => 40,
                'contact' => '+81-92-512-1919',
                'price' => 1.60,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Nakasu Yatai Village',
                'description' => 'Traditional food stall serving yakitori, oden and local specialties',
                'address' => 'Nakasu, Hakata Ward, Fukuoka',
                'prefecture_id' => 40,
                'contact' => '+81-92-291-4595',
                'price' => 3.50,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Hiroshima restaurants (prefecture_id = 31) 
            [
                'restaurant_name' => 'Hassei Hiroshima Okonomiyaki',
                'description' => 'Authentic Hiroshima-style okonomiyaki with layers of ingredients',
                'address' => '5-13 Shintenchi, Naka Ward, Hiroshima',
                'prefecture_id' => 31,
                'contact' => '+81-82-247-8529',
                'price' => 1.40,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Kanawa Oyster Restaurant',
                'description' => 'Fresh Hiroshima oysters prepared in traditional and modern styles',
                'address' => '1-15 Otemachi, Naka Ward, Hiroshima',
                'prefecture_id' => 31,
                'contact' => '+81-82-541-7416',
                'price' => 8.50,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

            // Kanagawa restaurants (prefecture_id = 12)
            [
                'restaurant_name' => 'Yokohama Chinatown Heichinrou',
                'description' => 'Historic Chinese restaurant in Yokohama Chinatown since 1884',
                'address' => '164 Yamashitacho, Naka Ward, Yokohama, Kanagawa',
                'prefecture_id' => 12,
                'contact' => '+81-45-681-3001',
                'price' => 12.00,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'restaurant_name' => 'Kamakura Komameya Ramen',
                'description' => 'Traditional ramen shop in historic Kamakura with homemade noodles',
                'address' => '2-11-16 Komachi, Kamakura, Kanagawa',
                'prefecture_id' => 12,
                'contact' => '+81-467-25-3500',
                'price' => 1.90,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];

        //insert vào database
        foreach ($restaurant as $value) {
            DB::table('restaurants')->insert($value);
        }
    }
}
