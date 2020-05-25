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







/>
