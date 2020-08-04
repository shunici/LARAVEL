<?php
//model
 protected $fillable = ['nama', 'kategori', 'stok', 'deskripsi', 'foto', 'umum', 'reseller', 'satuan'];
}


//controller
 public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('bahans')->latest()->get();
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){                      
                        $button = '<a href=" bahan/show/'.$data->id.' " class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';  
                        $button .= '&nbsp;<a href="bahan/edit/ '.$data->id.' " class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';                         
                        $button .= ' <a href="#" data-name="'.$data->nama.'"  class="hapus btn btn-danger btn-sm"  data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        return $button;
                    })
                    ->editColumn('stok', '{{$stok}} {{$satuan}}')
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
    $kurangi = Image::make($foto);
    $kurangi->resize(500, 500, function($constraint){
        $constraint->aspectRatio();
    })->save($path. '/' .$images);
    return $images;
   }


    public function show ($id)
    {
        $data = bahan::find($id);
        return view ('bahan_area.bahan.show', ['data' => $data]);
    }

    public function delete ( Request $request)
    {
      $data = bahan::find($request->id);
      $data->delete();
      
    }
    
    //route
    Route::group(['prefix' => 'bahan'], function(){
    Route::get('/', 'bahan_area\bahanController@index')->name('bahan-index');
    Route::get('create', 'bahan_area\bahanController@create')->name('bahan-create');
    Route::post('store', 'bahan_area\bahanController@store')->name('bahan-store');
    Route::get('show/{id}', 'bahan_area\bahanController@show')->name('bahan-show');
    Route::get('edit/{id}', 'bahan_area\bahanController@edit')->name('bahan-edit');
    Route::post('update/{id}', 'bahan_area\bahanController@update')->name('bahan-update');
    Route::post('delete', 'bahan_area\bahanController@delete')->name('bahan-delete');
});

//blade index
     <table class="table table-bordered  " id="users-table">
                            <thead>               
                            <tr>
                              <th>No</th>
                              <th>Nama Bahan</th>
                              <th>Kategori</th>
                              <th>Deskripsi</th>
                              <th>Harga Umum</th>
                              <th>Harga Reseller</th>
                              <th>Stok Gudang</th>
                              <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                            </tbody>
                        </table>
                        
                       
                    </div>
                    <script>
                          
                        $(document).ready(function(){
                        var t = $('#users-table').DataTable({
                            //nomor
                            "columnDefs": [ {
                                "searchable": false,
                                "orderable": false,
                                "targets": 0
                            } ],
                            "order": [[ 1, 'asc' ]],


                             processing : true,
                             serverside : true,
                             ajax : "{{route('bahan-index')}}",
                             "language": {
                                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json"
                             },
                             columns : [
                                 {data : 'id', name : 'id'},
                                 { data : 'nama', name : 'nama'},
                                 {data : 'kategori', name: 'kategori'},
                                 {data : 'deskripsi', name: 'deskripsi'},
                                 {data : 'umum', name: 'umum', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp ' )},
                                 {data : 'reseller', name: 'reseller', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp ' )}, 
                                 {data : 'stok', name : 'stok'},
                                 {data : 'aksi', name : 'aksi', orderable : false, searchable:false, printable:false}
                               
                             ],
                             dom: 'Bfrtip',
                             buttons: [
                                    {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i> Copy',
                                        titleAttr: 'Copy'
                                    },
                                    {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i> Excel',
                                        titleAttr: 'Excel'
                                    },
                                    {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"> </i> CSV',
                                        titleAttr: 'CSV'
                                    },
                                    {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                                        titleAttr: 'PDF'
                                    },
                                    {
                                        extend:    'print',
                                        text:      '<i class="fa fa-file-print-o"> </i> Print',
                                        title : '',
                                        titleAttr: 'Print',
                                        orientation: 'landscape',
                                        messageTop: '<style media="print">@page {size: auto;margin: 0;}body{margin: 0mm 10mm 10mm 10mm;}</style><div class="kop" style="text-align: center; width: 100%"><div class="logo" style="width: 20%; float: left;"><img src="/uploads/benawa.png" style="width: 150px"></div><div class="text" style="width: 80%; font-family: arial;"><p><font size="5"><b>BENAWA DIGITAL PRINTING</b></font><br>Indoor and Outdoor Promotion <br>Jalan Delima No. 07 Guntung Paikat Banjarbaru</p><font size="3"><b style="text-align: center">List Daftar Bahan</b></font></div></div> <br>',
                                        messageBottom: '<div class="text-footer" style=" width: 100%; "><div class="satu" style="width: 20%; float: left; background-color: yellow"></div><div class="dua" style="width: 50%; float: left; background-color: red"></div><div class="tiga" style="width: 30%; float: right; font-size: 12pt"><p style="text-align: left"> <font size="2"> <br>  <?php echo \Carbon\Carbon::parse(Date::now())->format('l, j F Y') ?> <br>Mengetahui, <br><br><br> <?php echo auth::user()->name;  ?> </font></p></div></div>',
                                        //untuk menyimpan kolom
                                        exportOptions: {
                                            columns: [ 0, 1, 2, 3, 4, 5,6 ]
                                        }
                                    }
                                ], //tutup button                                              
                             
                            })  
                            //nomor urut
                            t.on( 'order.dt search.dt', function () {
                                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                    cell.innerHTML = i+1;
                                } );
                            } ).draw();                  
                 
                        });
                        //hapus
                        $(document).on('click', '.hapus', function(e){                            
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            e.preventDefault();
                            var delete_id = $(this).data('id');  
                            var isi = $(this).data('name');                          
                            swal({
                            title: "Yakin Menghapus " + isi+ ' ?',
                            text: "Data akan hilang permanen",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                            }).then(function(value){
                                if(value){
                                   
                                    $.ajax({
                                        type : 'post',
                                        url : "{{route('bahan-delete')}}",
                                        data: {id:delete_id},
                                        success : function(data){
                                            location.reload(); 
                                        }
                                    })
                                }
                            })
                        });
                       
                                   
                         </script>  
             
             
             //blade  create
             
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
                            <img src="/uploads/bahan/bahan_default.png" style="width:20%; " id="preview">
                             <input name="foto" type="file" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> 
                           </div>
                           <div class="form-group">
                            <label for="harga_umum">Harga Umum</label>
                            <input type="text" class="form-control" id="harga_umum" name="umum" placeholder="Masukkan Harga Umum Bahan">
                           </div>
                           <div class="form-group">
                            <label for="harga_reseller">Harga Reseller</label>
                            <input type="text" class="form-control" id="harga_reseller" name="reseller" placeholder="Masukkan Harga reseller Bahan">
                           </div>
                           <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" name="satuan" style="height: 35px"
                            onchange="if(this.options[this.selectedIndex].value=='lainnya'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                                <option>Roll</option>
                                <option>Pcs</option>
                                <option>Lembar</option>                                                            
                                <option value="lainnya">[keterangan lain]</option>    
                            </select><input name="satuan" class="form-control" style="display:none"
                              disabled="disabled" onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                          </div>
                      
                        </div>
                        <!-- /.box-body -->
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}">
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                    </form>      
            {{-- custom radio button  --}}
  {{-- custom radio button  --}}
            <script>
                function toggleField(hideObj,showObj){
                 hideObj.disabled=true;		
                 hideObj.style.display='none';
                 showObj.disabled=false;	
                 showObj.style.display='inline';
                 showObj.focus();
                }
                </script>
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
                                                window.location.reload(); 
                                            }); //tutup then
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
                    // penulisan uang

                    var harga_umum = document.getElementById('harga_umum');
                                harga_umum.addEventListener('keyup', function(e)
                                {
                                    harga_umum.value = formatRupiah(this.value);
                                });
                                var harga_reseller = document.getElementById('harga_reseller');
                                harga_reseller.addEventListener('keyup', function(e)
                                {
                                    harga_reseller.value = formatRupiah(this.value);
                                });
                                
                                
                                
                                function formatRupiah(angka, prefix)
                                {
                                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                        split	= number_string.split(','),
                                        sisa 	= split[0].length % 3,
                                        rupiah 	= split[0].substr(0, sisa),
                                        ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
                                        
                                    if (ribuan) {
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }
                                    
                                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                                }
                    </script>
//blade edit

  <form role="form"  action="#" method="post">      
                        <div class="box-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Bahan" value="{{$data->nama}}">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" style="height: 35px"
                            onchange="if(this.options[this.selectedIndex].value=='ket lain'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                        <option >{{$data->kategori}}</option>    
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
                          <input type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Bahan" value="{{$data->deskripsi}}">
                          </div>
                          <div class="form-group">
                            <img src="/uploads/bahan/{{$data->foto}}" style="width:20%; " id="preview">
                             <input name="foto" type="file" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> 
                           </div>
                           <div class="form-group">
                            <label for="harga_umum">Harga Umum</label>
                           <input type="number" class="form-control" name="umum" placeholder="Masukkan Harga Umum Bahan" value="{{$data->umum}}">
                           </div>
                           <div class="form-group">
                            <label for="harga_reseller">Harga Reseller</label>
                            <input type="number" class="form-control" name="reseller" placeholder="Masukkan Harga reseller Bahan" value="{{$data->reseller}}">
                           </div>
                           <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" name="satuan" style="height: 35px"
                            onchange="if(this.options[this.selectedIndex].value=='lainnya'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                           <option>{{$data->satuan}}</option>
                            <option>Roll</option>
                                <option>Pcs</option>
                                <option>Lembar</option>                                                            
                                <option value="lainnya">[keterangan lain]</option>    
                            </select><input name="satuan" class="form-control" style="display:none"
                              disabled="disabled" onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                          </div>
                      
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" name="stok" value="{{$data->stok}}">
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}">
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                    </form>      
   <script>
                function toggleField(hideObj,showObj){
                 hideObj.disabled=true;		
                 hideObj.style.display='none';
                 showObj.disabled=false;	
                 showObj.style.display='inline';
                 showObj.focus();
                }
                </script>
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
                                url: "{{route('bahan-update', $data->id)}}",
                                data:new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: "json",
                                success: function (data) {                                     
                    
                                    if($.isEmptyObject(data.error)){                                                                     
                                         swal({
                                            title: data.sukses+" Berhasil Diupdate",
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
                    
                    //blade
                    
lihat file foto, waktu jensegger dll
