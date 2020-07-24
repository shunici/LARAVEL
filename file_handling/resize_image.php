<?php


hanyalah sebuah fungsi

     //fungsi simpan
   private function simpan_gambar($nama, $foto)
   {
    $images = str_slug($nama) . time() . '.' . $foto->getClientOriginalExtension();
    $path = public_path('uploads/bahan');
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    $kurangi = Image::make($foto);
    $kurangi->resize(500, 500, function($constraint){
        $constraint->aspectRatio();
    })->save($path. '/' .$images);
    return $images;
   }
