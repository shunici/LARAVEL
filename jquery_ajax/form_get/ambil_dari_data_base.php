<!DOCTYPE html>
<html lang="en">
<head>
    
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
</head>
<body>
    <h1>get request ajax jquery</h1>
    <form action="#">      
        <button type="button" id="getRequest">ambil data</button>
        <p></p>
    </form>
    <script>
$(document).ready(function(){
    $('#getRequest').click(function(){
        $.get('/ambil_data', function(data){
            console.log(data);           
            $.each(data, function(i, value){
            //    ini diambil dari database
                $('p').append(value.nama + '<br>');
                $('p').append(value.keterampilan + '<br>');
            })
        })
    })
});
    </script>
    //ini adalah cara yang sama diatas
        <script>
$(document).ready(function(){
    $('#getRequest').click(function(){
       $.ajax({
           type: "get",
           url: "/ambil_data",
           data: "data",
           dataType: "json",
           success: function (data) {
              console.log(data);
              $.each(data, function(i, value){
            //    ini diambil dari database
                $('p').append(value.nama + '<br>');
                $('p').append(value.keterampilan + '<br>');
            })
           }
       });
    })
});
    </script>
</body>
</html>


//route

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function(){
    return view ('index');
});

Route::get('/ambil_data', function(){
    $users = DB::table('profils')->get();
    return response()->json($users);
});
?>
