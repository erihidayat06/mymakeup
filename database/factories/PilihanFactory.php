<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pilihan>
 */
class PilihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'jns_makeup' => $this->faker->sentence(mt_rand(2,3)),
            'slug' => $this->faker->slug(),
            'harga' => $this->faker->randomNumber(5,true),
            'deskripsi' => collect($this->faker->paragraphs(mt_rand(5,10)))
            ->map(fn($p) => "<p>$p</p>")
            ->implode(''),
            'category_id' => mt_rand(1,2)
        ];
    }
}
