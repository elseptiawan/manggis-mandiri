# How To Run

## Persiapan Database

1. Buka Aplikasi XAMPP, Download disini jika belum ada `https://www.apachefriends.org/download.html`
2. Jalankan service apache dan mysql pada xampp
3. Buka `localhost/phpmyadmin/`
4. Buat database baru (contoh nama database : manggis_mandiri)

## Set Up Program

1. Download Program dari repositori ini
2. Extract folder program yang telah didownload
3. Buka terminal pada direktori folder program
4. Install package menggunakan composer dengan command `composer install`, link download composer jika belum punya `https://getcomposer.org/download/`
5. Buat file dengan nama `.env`
6. Copy semua yang ada pada `.env.example` ke file `.env`
7. Pada line ke 14 ubah nama database sesuai dengan database baru yang telah dibuat di phpmyadmin, misal `DB_DATABASE=manggis_mandiri`
8. Migrasi database dengan command `php artisan migrate:fresh`
9. Seeding data admin dengan command `php artisan db:seed --class=UserSeeder`
10. Link storage ke public dengan command `php artisan storage:link`

11. Jalankan server dengan command `php artisan serve`
12. Buka web pada link `http://localhost:8000/`

Data Admin :
- email : admin@gmail.com
- password : password