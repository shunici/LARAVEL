composer require jenssegers/date
config app.php
provider
Jenssegers\Date\DateServiceProvider::class,

aliases
'Date' => Jenssegers\Date\Date::class,
<?php

posisi di controller
 date_default_timezone_set('Asia/Jakarta');
\Date::setLocale('id');


// output jum'at, 20 mei 2020
 $data = record_stok::all();
            return DataTables::of($data)                    
                    ->editColumn('created_at', function ($data) {
                        return  Date::parse($data->created_at)->format('l, j F Y');
                    })->make(true);
------------------------------------------------------------------  
//dihitung dari data pertama kali dibuat biasanya created_at
menggunakan methode diffForHumans();
// output 10 hari yang lau
$data = record_stok::all();
            return DataTables::of($data)                    
                    ->editColumn('created_at', function ($data) {
                        return  Date::parse($data->created_at)->diffForHumans();
                    })->make(true);
  





















/>
