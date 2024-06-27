## Pemesanan Tiket Konser
Proyek UAS Back-End Programming<br>
Anggota Kelompok 14 : <br>
    - Eriko Levino Sasmitra / 535220014 <br>
    - Sean Henry Wijaya / 535220019 <br>
    - Valentino Almendo Radjawane / 535220040 <br>

Untuk menjalankan aplikasi web ini, pastikan telah terinstall Node.js, xampp versi 8.2.12 dengan php, Composer, beserta aplikasi database yang diinginkan.<br>
Langkah-langkah menjalankan aplikasi web ini : <br>
1. Clone repository ini.<br>
2. Sesudah membuka folder aplikasi ini, run ```composer install```.<br>
3. Pastikan bahwa file .env telah terkonfigurasi dengan database yang diinginkan, default adalah mysql. Juga pastikan nama database yang benar. File .env.example yang ada bisa di repositori ini bisa di rename menjadi .env dan di konfigurasi bagian database connection agar memakai database yang benar.<br>
4. Run ```php artisan migrate```.<br>
5. Run ```php artisan db:seed```.<br>
6. Run ```npm install``` lalu ```npm run dev```.<br>
7. Run ```php artisan serve```.<br>
8. Buka di browser <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a><br>
9. Untuk login, <a href="http://127.0.0.1:8000/admin">http://127.0.0.1:8000/admin</a> dan ini email `admin@admin` dengan password `Adm1nAdm1n`.<br>

Untuk pembuatan event, diharapkan tidak membuat banyak seat class dengan total seat row yang besar karena proses tersebut bisa memakai memori yang besar, dan menyebabkan error ```Fatal Error: Allowed Memory Size of 'x' Bytes Exhausted (tried to allocate 'y' bytes)```, x adalah limit memori yang bisa dipakai dan y adalah total memori yang ingin dipakai.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
