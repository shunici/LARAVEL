<!DOCTYPE html>
<html lang="en">
<head>
    
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halaman dengan ajax jquery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <meta name="_token" content="{!! csrf_token() !!}"/>
    
</head>
<body>
    <h1>pencarian data</h1>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <form action="">
                  <input type="text" placeholder="cari.........." autofocus id="pencarian">  
                  <input type="hidden" value="" id="id_data">
                  <input name="_token" type="hidden" value="{!! csrf_token() !!}">                           
              </form>
              <div id="kolom_data">                  
              </div>
              
          </div>
    </div>
</div> 



<script>
    // ini buat select2
$(document).ready(function(){

$('#pencarian').keyup(function(){
    
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') }
    });
       var ambil = $(this).val();
       if(ambil != '')
       {
        var _token = $('input[name="_token"]').val();
        $.ajax({
         url:"/cari",
         method:"post",
         data:{
             ambil:ambil,
             _token:_token,
             },
         success:function(data){
          $('#kolom_data').fadeIn();  
                   $('#kolom_data').html(data);
         }
        });
       }
   });

   $(document).on('click', 'li', function(){  
     //mendapatkan id dari controller
      let ambil_id=  $(this).val();       
       $('#pencarian').val($(this).text());  
       $('#id_data').val(ambil_id);
       $('#kolom_data').fadeOut();  
   });  

});
</script>  

</body>
</html>

<?php

use Illuminate\Support\Facades\Route;
use App\profil;
use Illuminate\Http\Request;




Route::get('/', function(){
 return view('index');
});

Route::post('/cari', function(Request $request){
   if($request->get('ambil'))
   {
    $ambil = $request->get('ambil');
    $data = DB::table('profils')
      ->where('nama', 'LIKE', "%{$ambil}%")
      ->get();
    $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
    foreach($data as $row)
    {
     $output .= '
     <li style="padding-left : 10px" value=" '.$row->id.' ">'.$row->nama.'</li>
     ';
    }
    $output .= '</ul>';
    echo $output;
   }
   });
   ?>
