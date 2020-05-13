<?php

use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            [
                'id' => 1,
                'type' => 'Envío a domicilio',
            ],
            [
                'id' => 2,
                'type' => 'Recoge en tienda',
            ],
            [
                'id' => 3,
                'type' => 'Entrega en punto',
            ],
        ]);
    }
}
