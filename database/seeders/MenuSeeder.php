<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DateTime;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('table_menu')->truncate();
        Schema::enableForeignKeyConstraints();

        // Lấy tất cả restaurant IDs
        $restaurant_ids = DB::table('restaurants')->pluck('restaurant_id')->toArray();

        // Định nghĩa template các món ăn Nhật Bản
        $dish_templates = [
            // Ramen varieties
            [
                'dish_name' => 'Tonkotsu Ramen',
                'price' => 12.50,
                'description' => 'Rich pork bone broth ramen with chashu pork, green onions, and soft-boiled egg'
            ],
            [
                'dish_name' => 'Miso Ramen',
                'price' => 11.80,
                'description' => 'Fermented soybean paste broth with corn, bamboo shoots, and ground pork'
            ],
            [
                'dish_name' => 'Shoyu Ramen',
                'price' => 10.90,
                'description' => 'Clear soy sauce based broth with chicken, nori, and menma'
            ],

            // Sushi & Sashimi
            [
                'dish_name' => 'Salmon Sashimi',
                'price' => 18.50,
                'description' => 'Fresh Atlantic salmon sliced thin, served with wasabi and soy sauce'
            ],
            [
                'dish_name' => 'Tuna Sashimi',
                'price' => 22.00,
                'description' => 'Premium bluefin tuna sashimi with traditional accompaniments'
            ],
            [
                'dish_name' => 'Chirashi Bowl',
                'price' => 25.80,
                'description' => 'Assorted fresh sashimi over seasoned sushi rice'
            ],

            // Tempura
            [
                'dish_name' => 'Ebi Tempura',
                'price' => 16.50,
                'description' => 'Crispy fried shrimp tempura with tentsuyu dipping sauce'
            ],
            [
                'dish_name' => 'Vegetable Tempura',
                'price' => 12.80,
                'description' => 'Assorted seasonal vegetables in light crispy batter'
            ],
            [
                'dish_name' => 'Mixed Tempura Set',
                'price' => 19.90,
                'description' => 'Combination of shrimp and vegetable tempura with rice and miso soup'
            ],

            // Teriyaki & Grilled
            [
                'dish_name' => 'Chicken Teriyaki',
                'price' => 15.50,
                'description' => 'Grilled chicken thigh glazed with sweet teriyaki sauce'
            ],
            [
                'dish_name' => 'Beef Teriyaki',
                'price' => 21.00,
                'description' => 'Premium beef sirloin with homemade teriyaki glaze'
            ],
            [
                'dish_name' => 'Salmon Teriyaki',
                'price' => 18.80,
                'description' => 'Grilled salmon fillet with teriyaki sauce and steamed vegetables'
            ],

            // Curry & Rice
            [
                'dish_name' => 'Katsu Curry',
                'price' => 14.20,
                'description' => 'Crispy pork cutlet with Japanese curry sauce over rice'
            ],
            [
                'dish_name' => 'Chicken Curry',
                'price' => 12.50,
                'description' => 'Tender chicken in mild Japanese curry with vegetables'
            ],
            [
                'dish_name' => 'Beef Curry',
                'price' => 16.80,
                'description' => 'Slow-cooked beef in rich curry sauce with potatoes and carrots'
            ],

            // Noodles
            [
                'dish_name' => 'Yakisoba',
                'price' => 9.80,
                'description' => 'Stir-fried wheat noodles with vegetables and yakisoba sauce'
            ],
            [
                'dish_name' => 'Udon Soup',
                'price' => 8.50,
                'description' => 'Thick wheat noodles in savory dashi broth with tempura'
            ],
            [
                'dish_name' => 'Cold Soba',
                'price' => 10.20,
                'description' => 'Chilled buckwheat noodles with dipping sauce and wasabi'
            ],

            // Appetizers
            [
                'dish_name' => 'Gyoza',
                'price' => 6.80,
                'description' => 'Pan-fried pork and vegetable dumplings (6 pieces)'
            ],
            [
                'dish_name' => 'Edamame',
                'price' => 4.50,
                'description' => 'Steamed young soybeans with sea salt'
            ],
            [
                'dish_name' => 'Agedashi Tofu',
                'price' => 7.20,
                'description' => 'Lightly fried tofu in savory dashi broth with grated daikon'
            ],

            // Desserts
            [
                'dish_name' => 'Mochi Ice Cream',
                'price' => 6.50,
                'description' => 'Sweet rice cake filled with ice cream (3 pieces)'
            ],
            [
                'dish_name' => 'Dorayaki',
                'price' => 4.80,
                'description' => 'Pancake sandwich filled with sweet red bean paste'
            ],
            [
                'dish_name' => 'Matcha Cheesecake',
                'price' => 8.20,
                'description' => 'Creamy Japanese green tea flavored cheesecake'
            ]
        ];

        $menu_data = [];

        // Tạo menu cho mỗi restaurant
        foreach ($restaurant_ids as $restaurant_id) {
            // Mỗi restaurant có 3-5 món ăn ngẫu nhiên
            $num_dishes = rand(3, 5);

            // Random chọn các món không trùng lặp
            $selected_dishes = array_rand($dish_templates, $num_dishes);

            // Nếu chỉ có 1 món được chọn, array_rand trả về integer thay vì array
            if (!is_array($selected_dishes)) {
                $selected_dishes = [$selected_dishes];
            }

            foreach ($selected_dishes as $dish_index) {
                $dish = $dish_templates[$dish_index];

                // Thêm variation để tránh trùng lặp hoàn toàn
                $price_variation = rand(90, 120) / 100; // 90% to 120% of original price
                $final_price = round($dish['price'] * $price_variation, 2);

                $menu_data[] = [
                    'restaurant_id' => $restaurant_id,
                    'dish_name' => $dish['dish_name'],
                    'price' => $final_price,
                    'description' => $dish['description'],
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ];
            }
        }

        // Insert tất cả dữ liệu vào database
        foreach ($menu_data as $menu) {
            DB::table('table_menu')->insert($menu);
        }

        // Đảm bảo các restaurant có ít hơn 3 món sẽ được thêm món
        $this->ensureMinimumMenuItems($restaurant_ids, $dish_templates);

        echo "✅ Created " . count($menu_data) . " menu items for " . count($restaurant_ids) . " restaurants.\n";
        echo "✅ Each restaurant has at least 3 menu items.\n";
    }

    /**
     * Đảm bảo mỗi restaurant có ít nhất 3 món ăn
     */
    private function ensureMinimumMenuItems($restaurant_ids, $dish_templates)
    {
        foreach ($restaurant_ids as $restaurant_id) {
            $current_count = DB::table('table_menu')
                ->where('restaurant_id', $restaurant_id)
                ->count();

            if ($current_count < 3) {
                $needed = 3 - $current_count;

                // Lấy các món chưa có trong restaurant này
                $existing_dishes = DB::table('table_menu')
                    ->where('restaurant_id', $restaurant_id)
                    ->pluck('dish_name')
                    ->toArray();

                $available_dishes = array_filter($dish_templates, function ($dish) use ($existing_dishes) {
                    return !in_array($dish['dish_name'], $existing_dishes);
                });

                // Thêm món còn thiếu
                $additional_dishes = array_rand($available_dishes, min($needed, count($available_dishes)));

                if (!is_array($additional_dishes)) {
                    $additional_dishes = [$additional_dishes];
                }

                foreach ($additional_dishes as $dish_index) {
                    $dish = $available_dishes[$dish_index];

                    DB::table('table_menu')->insert([
                        'restaurant_id' => $restaurant_id,
                        'dish_name' => $dish['dish_name'],
                        'price' => round($dish['price'] * rand(95, 105) / 100, 2),
                        'description' => $dish['description'],
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime(),
                    ]);
                }
            }
        }
    }
}
