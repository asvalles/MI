<?php

use Illuminate\Database\Seeder;

use App\Puntuacion;

class PuntosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $punto = new Puntuacion();
        $punto->puntos = 25;
        $punto->activo = 1;
        $punto->user_id = 1;
        $punto->save();
    }
}
