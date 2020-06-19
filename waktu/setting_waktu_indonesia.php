// App\Providers\AppServiceProvider

public function boot()
{
	config(['app.locale' => 'id']);
	Carbon::setLocale('id');
	date_default_timezone_set('Asia/Jakarta');

}

// config/app.php

    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'faker_locale' => 'id_ID',
    
    setting lokal waktu timezone indonesia pada laravel
    
