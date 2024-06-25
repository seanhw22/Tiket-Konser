<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin',
                'email_verified_at' => NULL,
                'password' => '$2y$10$aNsmHhDk8PHrtLhvkmQp3OWLTyu9Fzuq7HAgUphSac9eukPpROhwK',
                'remember_token' => '0XYRQxeRQwlXtxt4AGj6JBIoCiLaZlGe7Mog8LBJT2zcH5EszUCuLxuloV69',
                'created_at' => '2024-06-25 10:29:22',
                'updated_at' => '2024-06-25 10:44:45',
            ),
        ));
        
        
    }
}