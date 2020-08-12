// App\Providers\AppServiceProvider

<?php
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
    
    //setting lokal waktu timezone indonesia pada laravel

//cara menampilkannya diblade view
<h2> <?php echo \Carbon\Carbon::parse(Date::now())->format('l, j F Y') ?> </h2>
//output dibaca tanggal sekarang
    
