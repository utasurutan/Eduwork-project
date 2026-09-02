# Yio - Laravel Breeze Setup

## 1. Install Breeze
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run dev
php artisan migrate
```

## 2. Terapkan file custom
- Copy `resources/views/components/application-logo.blade.php` ke project (replace file bawaan)
- Copy `resources/views/layouts/guest.blade.php` ke project (replace file bawaan)
- Copy isi `env-snippet.txt` ke file `.env` project kamu (replace baris `APP_NAME`)
- Ganti logo di `public/images/logo.png` dengan logo Yio kamu

## 3. Jalankan
```bash
php artisan serve
```
