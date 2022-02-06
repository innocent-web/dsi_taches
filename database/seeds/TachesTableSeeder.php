<?php

use Illuminate\Database\Seeder;

class TachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Tache::class,25)->create();
    }
}
