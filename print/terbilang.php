mata uang, dan penanggalan waktu bahasa indonesia juga ada di link berikut
https://karjonoblog.wordpress.com/2019/01/12/cara-membuat-helper-di-laravel-untuk-ditampilkan-melalui-view/


buat folder helper atau apapun di subfolder App
buat file uang_terbilang.php

isikan dibawah ini
<?php
function terbilang($angka) {
   $angka=abs($angka);
   $baca =array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 
   $terbilang="";
    if ($angka < 12){
        $terbilang= " " . $baca[$angka];
    }
    else if ($angka < 20){
        $terbilang= terbilang($angka - 10) . " belas";
    }
    else if ($angka < 100){
        $terbilang= terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    }
    else if ($angka < 200){
        $terbilang= " seratus" . terbilang($angka - 100);
    }
    else if ($angka < 1000){
        $terbilang= terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    }
    else if ($angka < 2000){
        $terbilang= " seribu" . terbilang($angka - 1000);
    }
    else if ($angka < 1000000){
        $terbilang= terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    }
    else if ($angka < 1000000000){
       $terbilang= terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    }
       return $terbilang;
}

/// jika sudah
Kemudian buka file composer.json dan tambahkan files pada autoload sehingga menjadi seperti berikut :
===================
"autoload": {
   "psr-4": {
     "App\\": "app/"
   },
   "files": [
       "app/Helper/uang_terbilang.php",      
   ],
   "classmap": [
      "database/seeds",
      "database/factories"
   ]
},

=====================
kemudian composer dump-autoload di commandpromt
   
   //jika sudah langsung ke blade
   <h1>  {{terbilang($data_uang)}} </h1>
