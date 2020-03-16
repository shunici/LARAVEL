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
                $('p').append(value.task + '<br>');
                $('p').append(value.description + '<br>');
            })
        })
    })
});
    </script>
</body>
</html>

//routenya

<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return view ('index');
});

Route::get('/ambil_data', function(){
    $users = DB::table('tasks')->get();
    return response()->json($users);
});
