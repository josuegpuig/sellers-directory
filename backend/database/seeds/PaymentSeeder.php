<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'type' => 'Efectivo',
            ],
            [
                'id' => 2,
                'type' => 'Tarjeta',
            ],
            [
                'id' => 3,
                'type' => 'Depósito',
            ],
        ]);
    }
}
