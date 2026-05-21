<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Sengaja dibiarkan kosong sesuai permintaan (isinya dibuat kosong aja)
        $reviews = [];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
