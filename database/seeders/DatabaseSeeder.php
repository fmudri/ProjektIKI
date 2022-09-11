<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Ako ovo pokrenemo, stvorit će 10 dummy users
        //prema pravilima definiranim u factories/UserFactory.php
        //  \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
          'name' => 'John Doe',
          'email' => 'john@gmail.com'
        ]);

          Listing::factory(6)->create([
            'user_id' => $user->id
          ]);

          /* Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'Laravel Javascript',
            'company' => 'Acme Corp',
            'location' => 'Osijek',
            'email' => 'email@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus scelerisque nulla vitae nisl egestas egestas non a ligula. In quis.'
          ]);

          Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'Laravel, backend, api',
            'company' => 'Stark Industries',
            'location' => 'Zagreb',
            'email' => 'email2@email.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus scelerisque nulla vitae nisl egestas egestas non a ligula. In quis.'
          ]); */
        
    }
}
