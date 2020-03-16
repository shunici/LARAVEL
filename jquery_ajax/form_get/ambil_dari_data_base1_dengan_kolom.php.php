<!DOCTYPE html>
<html lang="en">
<head>
    
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            }
            table, td, th {
            border: 1px solid black;
            }
    </style>
    
</head>
<body>
    <h1>get request ajax jquery</h1>
       
        <button type="button" id="getRequest">ambil data</button>
        <p></p>
        <table>
            <thead>
                <tr>
                    <th>nama</th>
                    <th>kemampuan</th>
                    <th>aksi</th>
                  </tr>
            </thead>
            <tbody id="data_masuk">
            </tbody>       
          </table>
          

 
    <script>
$(document).ready(function(){
    $('#getRequest').click(function(){
       $.ajax({
           type: "get",
           url: "/ambil_data",
           data: "data",
           dataType: "json",
           success: function (data) {   
               //jika diklik 2 kali data kosong  
            $('#data_masuk').empty();

              $.each(data, function(i, value){
                var tr = $('<tr/>');
                    tr.append($('<td/>',{
                        text : value.nama,                      
                    })).append($('<td/>',{
                        text : value.keterampilan,                      
                    })).append($('<td/>',{
                        html : '<a href="#">lihat</a> <a href="#">edit</a> <a href="#">hapus</a>',                    
                    }))

                $('#data_masuk').append(tr);             
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
