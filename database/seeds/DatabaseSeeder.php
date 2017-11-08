<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(DefaultDataSeeder::class);
        $this->call(TipoMaquinariaSeeder::class);
        $this->call(TipoMaterialSeeder::class);
        $this->call(TipoRegistroSeeder::class);
    }
}
