<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing read</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body style="background-color:grey">
   <h1>metode get dan post menggunakan jquery ajax</h1> 
<p>ini hasil yang diload</p>
<div id="hasilnya"></div>
<hr>
<form action="/post_data" method="POST">
    <input type="text" id="input_nama">    
    <input type="text" id="input_keterampilan"> 
    <input name="_token" type="hidden" value="{!! csrf_token() !!}">
    <button type="submit">insert data</button>
</form>
   
</body>
<script>
$(document).ready(function(){
       $.get('/ambil_data', function(data){
         $.each(data, function(i, value){
             $('#hasilnya').append(value.nama + '||'+value.keterampilan +'<br>');
         })
       })
       // insert data     
       $('form').submit(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('input[name="_token"]').attr('value');
        e.preventDefault();

           $.ajax({
               type: "POST",      
               dataType: "json",
               url: "/post_data",
               data: {
                   '_token' : CSRF_TOKEN,
                   nama : $('#input_nama').val(),
                   keterampilan : $('#input_keterampilan').val(),
                   },
               success: function (data) {
                window.location.reload();
              console.log(data);
              
               }             
           })
           
         
       })
})
</script>

</html>

//route

<?php
use Illuminate\Support\Facades\DB;
use App\profil;
use Illuminate\Http\Request;

Route::get('/', function(){
    return view ('index');
});

Route::get('/ambil_data', function(){
    return DB::table('profils')->get();
});

Route::post('/post_data', function(Request $request){


   return profil::create($request->all());
// return dd($request->all());
//    return response()->json(['berhasil'=>'belajar lah lagi dengan giat sampai mati.']);
});

?>
