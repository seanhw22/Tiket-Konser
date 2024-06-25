<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuyerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('buyer')->delete();
        
        \DB::table('buyer')->insert(array (
            0 => 
            array (
                'id' => 3,
                'created_at' => '2024-06-25 13:59:19',
                'updated_at' => '2024-06-25 13:59:19',
                'name' => 'Sean Henry Wijaya',
                'email' => 'sean.535220019@stu.untar.ac.id',
                'phone' => '081111111111',
                'event_id' => 1,
                'seat_id' => 1210,
            ),
        ));
        
        
    }
}