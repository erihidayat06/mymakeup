<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=> mt_rand(1,5),
            'pilihan_id' => mt_rand(1,5),
            'tgl_acara' => $this->faker->date(),
            'alamat' => collect($this->faker->paragraph(mt_rand(1,2)))
            ->map(fn($p)=>"<p>$p</p>")
            ->implode(''),
            'no_pesanan' => $this->faker->randomNumber(5,true)
        ];
    }
}
