<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event')->delete();
        
        \DB::table('event')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2024-06-25 11:36:57',
                'updated_at' => '2024-06-25 11:57:41',
                'event_name' => 'Elysium',
            'event_desc' => 'Konser Midyear Elysium "Igniting Sparks of Hope" ini dilaksanakan dalam rangka konser tengah tahun.<br><br>Oleh karena itu, kami mengundang anda sekalian untuk bersama-sama menyaksikan Konser Midyear kami pada :<br><br>Hari, Tanggal : Minggu, 21 Juli 2024<br>Pukul : 18.00 WIB (Open Gate) <br>Lokasi : Graha Swara, Lt. 8 Gedung M, Kampus 1 Universitas Tarumanagara. Jl. Letjen S. Parman No. 1, Jakarta Barat.<br><br>Harga Tiket<br>Normal Price<br>VIP : Rp150.000/Tiket<br>Reguler : Rp125.000/Tiket<br>Student : Rp80.000/Tiket (wajib menunjukkan KTM diri sendiri)',
                'event_image' => 'https://instagram.fcgk6-3.fna.fbcdn.net/v/t39.30808-6/441966287_18414802159066632_4120780795089058099_n.jpg?stp=dst-jpg_e35&efg=eyJ2ZW5jb2RlX3RhZyI6ImltYWdlX3VybGdlbi4xNDQweDE0NDAuc2RyLmYzMDgwOCJ9&_nc_ht=instagram.fcgk6-3.fna.fbcdn.net&_nc_cat=100&_nc_ohc=m0WIXV-j5_8Q7kNvgGboVjc&edm=AFg4Q8wAAAAA&ccb=7-5&ig_cache_key=MzM3MDUwNTkyNTEyOTE5NjcyMQ%3D%3D.2-ccb7-5&oh=00_AYBLgPcLOMgQf76Kic4rkCiWp1vymaGxjvWo0U_pgqjR8g&oe=66807F60&_nc_sid=0b30b7',
                'event_date' => '2024-07-21 18:00:00',
                'total_seat_columns' => 30,
                'deployed' => true,
                'end_date' => '2024-07-21 17:30:00',
            ),
        ));
        
        
    }
}