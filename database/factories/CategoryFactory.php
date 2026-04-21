<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
            'Electronics',
            'Smartphones',
            'Laptops',
            'Tablets',
            'Audio & Headphones',
            'Gaming Consoles',
            'Cameras',
            'TV & Video',
            'Home Appliances',
            'Kitchen Appliances',
            'Furniture',
            'Home Decor',
            'Clothing',
            'Men Clothing',
            'Women Clothing',
            'Shoes',
            'Sports & Outdoors',
            'Fitness Equipment',
            'Beauty & Personal Care',
            'Health & Wellness',
            'Toys & Games',
            'Books',
            'Stationery',
            'Automotive',
            'Pet Supplies',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->sentence(),
        ];
    }
}
