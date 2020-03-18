html ====
<p>ini hasil yang diload</p>
<div id="hasilnya"></div>

<script>
    $(document).ready(function(){
       $.get('/ambil_data', function(data){
         $.each(data, function(i, value){
             $('#hasilnya').text(value.keterampilan);
         })
       })
    })
</script>

route laravel========
<?php
use Illuminate\Support\Facades\DB;

Route::get('/', function(){
    return view ('index');
});

Route::get('/ambil_data', function(){
    return DB::table('profils')->get();
});
?>
