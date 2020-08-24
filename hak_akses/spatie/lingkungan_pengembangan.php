//install
composer require spatie/laravel-permission

//migrasi database
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"

// migrate datanya
php artisan migrate

//gunakan ini di model user
use Spatie\Permission\Traits\HasRoles;

//di dalam class
use Notifiable, HasRoles;

