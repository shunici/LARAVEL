//route
Route::group(['prefix' => 'bahan'], function(){
    Route::get('/', 'bahan_area\bahanController@index')->name('bahan-index');
    Route::get('create', 'bahan_area\bahanController@create')->name('bahan-create');
    Route::post('store', 'bahan_area\bahanController@store')->name('bahan-store');
    Route::get('show/{id}', 'bahan_area\bahanController@show')->name('bahan-show');
    Route::get('edit/{id}', 'bahan_area\bahanController@edit')->name('bahan-edit');
    Route::post('update/{id}', 'bahan_area\bahanController@update')->name('bahan-update');

});


/create
   <form role="form"  action="#" method="post" enctype="multipart/form-data">      
                        <div class="box-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Bahan">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" style="height: 35px"
                            onchange="if(this.options[this.selectedIndex].value=='ket lain'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                                <option>Outdoor</option>
                                <option>Indoor</option>
                                <option>Offset</option>  
                                <option>Merchandise</option>                             
                                <option value="ket lain">[keterangan lain]</option>    
                            </select><input name="kategori" class="form-control" style="display:none"
                              disabled="disabled" onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                          </div>
                          <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Bahan">
                          </div>
                          <div class="form-group">
                            <img src="/uploads/transaksi/default.png" style="width:20%; " id="preview">
                             <input name="foto" type="file" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> 
                           </div>
                           <div class="form-group">
                            <label for="harga_umum">Harga Umum</label>
                            <input type="number" class="form-control" name="umum" placeholder="Masukkan Harga Umum Bahan">
                           </div>
                           <div class="form-group">
                            <label for="harga_reseller">Harga Reseller</label>
                            <input type="number" class="form-control" name="reseller" placeholder="Masukkan Harga reseller Bahan">
                           </div>
                      
                        </div>
                        <!-- /.box-body -->
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}">
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                    </form>      
                     <script>                   
                    $(document).ready(function(){
                    
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    
                        $('form').submit(function(e){
                            var CSRF_TOKEN = $('input[name="_token"]').attr('value');
                            e.preventDefault();                   

                            $.ajax({
                                type: "post",
                                url: "{{route('bahan-store')}}",
                                data:new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: "json",
                                success: function (data) {                                     
                    
                                    if($.isEmptyObject(data.error)){                                                                     
                                         swal({
                                            title: data.sukses+" Berhasil Ditambahkan",
                                            text: "Kategori " +data.kategori,
                                            icon: "success",
                                            button: "Oke",
                                         }).then(function(){ 
                                                window.location.replace(data.url);
                                            }
                                        );
                                    }else{
                                    printErrorMsg(data.error);
                                    }
                                }
                            });
                            function printErrorMsg (msg) {
                                $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css('display','block');
                                $.each( msg, function( key, value ) {                                 
                                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                                });
                            }
                            
                        });
                      
                    });
                    </script>
                    
                    //controller
                    <?php

namespace App\Http\Controllers\bahan_area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use File;
use Image;
use App\bahan;
use DataTables;
class bahanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = bahan::latest()->get();
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){                      
                        $button = '<a href=" bahan/show/'.$data->id.' " class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detil</a>';  
                        $button .= '&nbsp;<a href="bahan/edit/ '.$data->id.' " class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';                         
                        $button .= ' <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>';
                        return $button;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }      
        return view ('bahan_area.bahan.index');
    }

    public function create()
    {
        return view ('bahan_area.bahan.create');
    }

    public function store(Request $request)
    {
       $validator = validator::make($request->all(), [
           'nama' => 'required', 
           'kategori' => 'required',
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
  
    public function edit ($id)
    {
        $data = bahan::find($id);        
        return view ('bahan_area.bahan.edit', compact('data'));
    }

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


    public function show ($id)
    {
        $data = bahan::find($id);
        return view ('bahan_area.bahan.show', ['data' => $data]);
    }


}

                    
