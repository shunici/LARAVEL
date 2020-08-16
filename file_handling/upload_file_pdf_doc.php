//harap install  composer require intervention/image
<?php>
use Illuminate\Http\UploadedFile;
use File;
use Image;

//controller
 public function store(Request $request)
    {
        $validator = validator::make($request->all(), [          
            'surat_dinas' =>  'required|mimes:pdf,xlx,csv|max:2048',
        ]);
       if ($validator->passes()) {               
         $file = null;
         //jika ada foto
         if($request->hasFile('surat_dinas')){
             //maka jalan kan methode simpan_gambar()
             $file = $this->simpan_file($request->file('surat_dinas'), $request->file('surat_dinas'));
         }
   
          return response()->json([          
            'url' => "/mutasi",    
             ]);       
       }
       return response()->json([
           'error' => $validator->errors()->all()
       ]);
    }
    
     private function simpan_file($nama, $file)
    {
     $file_gabung = str_slug($nama) . time() . '.' . $file->getClientOriginalExtension();
     $path = public_path('uploads/mutasi');
         if(!File::isDirectory($path)) {
             File::makeDirectory($path, 0777, true, true);
         }
    $file->move($path. '/' .$file_gabung);
     return $file_gabung;
    }
    
   //view blade
      <div class="form-group">
        <label for="surat_dinas">Surat Rekomendasi Dari Dinas</label>
        <input type="file" class="form-control" id="surat_dinas" name="surat_dinas">
    </div>
    
