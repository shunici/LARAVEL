https://github.com/jenssegers/date
install
composer require jenssegers/date
//taruh di config  pada provider
Jenssegers\Date\DateServiceProvider::class,

// taruh di config pada alias
'Date' => Jenssegers\Date\Date::class,

//cara penggunaan

web route ------
<?php
use Carbon\Carbon;
 
 
 Route::get('/', function(){
 \Date::setLocale('id');
  $bulan = 2;
   $tampil = \Date::parse($bulan)->format('F');
   return $tampil;
   //hasil februari
});

========================
$date= Carbon::now();
$waktu = \Date::parse($date)->format('Y-m-d H');
dd($waktu);
tampil
"2020-06-20 00"
 
 ===================
 
$date= Carbon::now();
$waktu = \Date::parse($date)->format('l, j F Y');
dd($waktu);
"Sabtu, 20 Juni 2020"



/>
