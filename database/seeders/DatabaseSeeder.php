<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'bett0',
            'email' => 'bett0',
            'password' => \Hash::make('123456'),
            'tipo' => 'administrador',
            'celular' => '77889944', 
            'direccion' => 'Calle Falsa 123',
            'id_mesa' => 1,
            'id_cliente' => 1,
            'baja' => 1,
        ]);
    }
}
