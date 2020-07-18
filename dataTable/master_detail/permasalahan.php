perhatikan dibagian table di blade..ada td kosong..
dan juga pada model jika ada atribut fungsi dibawah ini harap di buang karena tidak bisa dieksekusi
<?php
 public function getCreatedAtAttribute()
    {
        \Date::setLocale('id');
        return Date::parse($this->attributes['created_at'])->format('l, j F Y');
        // ->format('l j F Y ');
    }
    
  //untuk database penggunaan select() diperlukan dan sesuai kan pada tabel di databasenya
  
