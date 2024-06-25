<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuggestionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suggestion')->delete();
        
        \DB::table('suggestion')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2024-06-25 13:50:18',
                'updated_at' => '2024-06-25 14:00:35',
                'name' => 'Sean',
                'email' => 'sean.535220019@stu.untar.ac.id',
                'phone' => '08111111111',
                'message' => 'Website ok yooo',
                'checked' => true,
                'pinned' => true,
            ),
        ));
        
        
    }
}