<?php

use App\Requiproyecto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class RequiproyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requiproyecto::create([
            'id'=>'1',
            'detproyecto'=>'SI',
            'slug'=>Str::slug('SI', '-'),
        ]);

        Requiproyecto::create([
            'id'=>'2',
            'detproyecto'=>'NO',
            'slug'=>Str::slug('NO', '-'),
        ]);
    }
}
