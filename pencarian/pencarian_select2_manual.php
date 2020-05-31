//route
<?php
 Route::post('/cari/kostumer', 'data_cetakan\transaksiController@cari_pelanggan')->name('cari_pelanggan');


//controller
use Illuminate\Support\Facades\DB;
 public function cari_pelanggan (Request $request)
    {
        if($request->get('ambil'))
        {
         $ambil = $request->get('ambil');
         $data = DB::table('pelanggans')
           ->where('nama', 'LIKE', "%{$ambil}%")
           ->get();
         $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
         foreach($data as $row)
         {
          $output .= '
          <li style="padding-left : 10px" value=" '.$row->id.' ">'.$row->nama.' <span style="background-color:yellow;">'.$row->status_plg.'</li>
          ';
         }
         $output .= '</ul>';
         echo $output;
        }
    }

HTML JS

<div class="form-group">
       <input type="text"  id="nama_kostumer" class="form-control input-lg" placeholder="Masukkan nama Kostumer" value=""/>
       <input type="hidden" name="pelanggan_id" value="" id="id_nama_kostumer">
         <div id="kolom_daftar_kostumer">
</div>
<script>
$(document).ready(function(){

       $('#nama_kostumer').keyup(function(){ 
              var ambil = $(this).val();
              if(ambil != '')
              {
              var _token = $('input[name="_token"]').val();
              $.ajax({
              url:"{{ route('cari_pelanggan') }}",
              method:"POST",
              data:{ambil:ambil, _token:_token},
              success:function(data){
              $('#kolom_daftar_kostumer').fadeIn();  
                     $('#kolom_daftar_kostumer').html(data);
              }
              });
              }
       });

   $(document).on('click', 'li', function(){  
     //mendapatkan id dari controller
      let ambil_id=  $(this).val();       
       $('#nama_kostumer').val($(this).text());  
       $('#id_nama_kostumer').val(ambil_id);
       $('#kolom_daftar_kostumer').fadeOut();  
   });  

});
</script>







/>
