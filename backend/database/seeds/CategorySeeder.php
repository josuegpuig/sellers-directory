<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'category' => 'Abarrotes',
                'description' => 'Comercio de abarrotes',    
            ],
            [
                'id' => 2,
                'category' => 'Alimentos',
                'description' => 'Comercio de alimentos',    
            ],
            [
                'id' => 3,
                'category' => 'Autoservicio',
                'description' => 'Comercio de supermercados o minisupers',    
            ],
            [
                'id' => 4,
                'category' => 'Textiles',
                'description' => 'Comercio de telas',    
            ],
            [
                'id' => 5,
                'category' => 'Ropa',
                'description' => 'Comercio de ropa',    
            ],
            [
                'id' => 6,
                'category' => 'Cuidado de la salud',
                'description' => 'Comercio de artículos para la salud',    
            ],
            [
                'id' => 7,
                'category' => 'Papelería',
                'description' => 'Comercio de papelería',    
            ],
            [
                'id' => 8,
                'category' => 'Perfurmería',
                'description' => 'Comercio de perfumería',    
            ],
            [
                'id' => 9,
                'category' => 'Mascotas',
                'description' => 'Comercio de mascotas y artículos para mascotas',    
            ],
            [
                'id' => 10,
                'category' => 'Cuidado de la salud',
                'description' => 'Comercio de artículos para la salud',    
            ],
            [
                'id' => 11,
                'category' => 'Muebles',
                'description' => 'Comercio de muebles',    
            ],
            [
                'id' => 12,
                'category' => 'Tecnología',
                'description' => 'Comercio de celulares, computación, etc',    
            ],
            [
                'id' => 13,
                'category' => 'Ferretería',
                'description' => 'Comercio de ferretería',    
            ],
            [
                'id' => 14,
                'category' => 'Tlapalería',
                'description' => 'Comercio de tlapalería',    
            ],
            [
                'id' => 15,
                'category' => 'Refacciones',
                'description' => 'Comercio de refacciones para vehículos',    
            ],
            [
                'id' => 16,
                'category' => 'Servicios digitales',
                'description' => 'Comercio de servicios digitales (creación de páginas, mantenimiento, etc)',    
            ],
        ]);
    }
}
