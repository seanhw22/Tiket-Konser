<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SeatclassTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('seatclass')->delete();
        
        \DB::table('seatclass')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2024-06-25 11:36:57',
                'updated_at' => '2024-06-25 11:45:09',
                'event_id' => 1,
                'seat_class' => 'VIP',
                'price' => 150000,
                'total_seat_rows' => 3,
                'color_code' => '#81a2a7',
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2024-06-25 11:36:57',
                'updated_at' => '2024-06-25 11:45:09',
                'event_id' => 1,
                'seat_class' => 'Reguler',
                'price' => 125000,
                'total_seat_rows' => 7,
                'color_code' => '#d8d8d8',
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2024-06-25 11:36:57',
                'updated_at' => '2024-06-25 11:45:09',
                'event_id' => 1,
                'seat_class' => 'Student',
                'price' => 80000,
                'total_seat_rows' => 3,
                'color_code' => '#ada6d0',
            ),
        ));
        
        
    }
}