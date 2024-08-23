<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      $this->call(UsersSeeder::class);
      $this->call(ProvinciasSeeder::class);
      $this->call(LocalidadesSeeder::class);
      $this->call(InstitucionesSeeder::class);
      $this->call(Obras_socialesSeeder::class);
      $this->call(ProfesionesSeeder::class);
      $this->call(Estados_turnosSeeder::class);
   }
}
