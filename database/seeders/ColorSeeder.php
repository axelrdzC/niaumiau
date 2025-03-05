<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            ['nombre' => 'Rosa', 'hex' => '#EFC3CA'],
            ['nombre' => 'Violeta', 'hex' => '#CC6CE7'],
            ['nombre' => 'Azul', 'hex' => '#050086'],
            ['nombre' => 'Celeste', 'hex' => '#5DE2E7'],
            ['nombre' => 'Verde', 'hex' => '#7DDA58'],
            ['nombre' => 'Lima', 'hex' => '#BFD641'],
            ['nombre' => 'Amarillo', 'hex' => '#FFD91D'],
            ['nombre' => 'Beige', 'hex' => '#FFECA1'],
            ['nombre' => 'Naranja', 'hex' => '#FE9900'],
            ['nombre' => 'Rojo', 'hex' => '#E4080A'],
            ['nombre' => 'Cafe', 'hex' => '#805849'],
            ['nombre' => 'Negro', 'hex' => '#000000'],
            ['nombre' => 'Gris', 'hex' => '#CECECE'],
            ['nombre' => 'Blanco', 'hex' => '#FFFFFF'],
        ]);
    }
}
