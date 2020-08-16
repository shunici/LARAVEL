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
         //jika ada file
         if($request->hasFile('surat_dinas')){           
             $file = $this->simpan_file('mutasi_surat_dinas', $request->file('surat_dinas'));
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
     $file->move($path, $file_gabung);
     return $file_gabung;
    }

//alternatif simpel tanpa fungsi 
$fileName = time().'.'.$request->surat_dinas->extension();     
$request->surat_dinas->move(public_path('uploads'), $fileName);

    
   //view blade
      <div class="form-group">
        <label for="surat_dinas">Surat Rekomendasi Dari Dinas</label>
        <input type="file" class="form-control" id="surat_dinas" name="surat_dinas">
    </div>
    
