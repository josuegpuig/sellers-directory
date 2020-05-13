<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'id' => 1,
                'type' => 'Facebook',
            ],
            [
                'id' => 2,
                'type' => 'Instagram',
            ],
            [
                'id' => 3,
                'type' => 'Página Web',
            ],
            [
                'id' => 4,
                'type' => 'Otro',
            ],
        ]);
    }
}
