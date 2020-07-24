




<?php








//blade
  <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Bahan">
  
 <div class="form-group">
<img src="/uploads/bahan/bahan_default.png" style="width:20%; " id="preview">
 <input name="foto" type="file" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> 
</div>

//controller
use File;
use Image;

//create
 public function store(Request $request)
    {
       $validator = validator::make($request->all(), [
           'nama' => 'required',          
           "foto" => 'required',     
       ]);
      if ($validator->passes()) {
         //foto default kosong
         $foto = null;
         //jika ada foto
         if($request->hasFile('foto')){
             //maka jalan kan methode simpan_gambar()
             $foto = $this->simpan_gambar($request->nama, $request->file('foto'));
         }

         $input = $request->all();
         $input['foto'] = $foto;
         bahan::create($input);

         return response()->json([
            'sukses'=> $request->nama,
           'url' => "/bahan",
           'kategori' => $request->kategori,
            ]);       
      }
       return response()->json([
           'error' => $validator->errors()->all()
       ]);
    }
    
    
  //update
  public function update (Request $request, $id)
    {
       
        $validator = validator::make($request->all(), [
            'nama' => 'required',
            'kategori' => 'required',
        ]);

        if ($validator->passes()) {
          $data = bahan::findOrFail($id);
          $foto = $data->foto;
            if($request->hasFile('foto')){
                !empty($foto) ? File::delete(public_path('uploads/bahan/' .$foto)):null;
                $foto = $this->simpan_gambar($request->nama, $request->file('foto'));
            }
            
            $input = $request->all();
            $input['foto'] = $foto;
            $data->update($input);
            return response()->json([
                'sukses'=> $request->nama,
               'url' => "/bahan",
               'kategori' => $request->kategori,
                ]);

        }
        return response([
            'error' => $validator->errors()->all()
        ]);
       
    }

      //fungsi simpan
   private function simpan_gambar($nama, $foto)
   {
    $images = str_slug($nama) . time() . '.' . $foto->getClientOriginalExtension();
    $path = public_path('uploads/bahan');
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    Image::make($foto)->save($path. '/' .$images);
    return $images;
   }
   
   jangan lupa install
   composer require intervention/image
