<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing read</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        .container {
            width: 50%;
        }

    </style>
    
</head>
<body style="background-color:grey">
    <div class="container">
        <h1>mengedit dan update dengan jquery laravel ajax</h1> 
        <p>ini hasil yang diload</p>        
            <table style="width:100%">
                <tr>
                <th>No</th>
                <th>Nama</th> 
                <th>Keterangan</th>
                <th>aksi</th>
                </tr>
                @foreach ($data_db as $row)   
                <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->nama}}</td>
                <td>{{$row->keterampilan}}</td>
                <td>
                <a href="#"  onclick="formEdit({{$row->id}})">edit</a>
                    <a onclick="event.preventDefault(); formDelet({{$row->id}});" href="">delet</a>
                    </td>
                </tr>  
                @endforeach     
            </table>

            <div class="clearfix">
                <div class="hint-text">Showing <b>{{$data_db->count()}}</b> out of <b>{{$data_db->total()}}</b> entries</div>
                {{ $data_db->links() }}
            </div>

        <hr>
        <form action="/post_data" method="POST">
            <input type="hidden" id="input_id">   
            <input type="text" id="input_nama">    
            <input type="text" id="input_keterampilan"> 
            <input name="_token" type="hidden" value="{!! csrf_token() !!}">
            <button type="submit">insert data</button>
        </form>
</div>
</body>
<script>
$(document).ready(function(){
       

      
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
       });    

});
//edit data memakai javascript biasa untuk mengambil id dari coding laravel $row->id
        function formEdit (data_id){         
            event.preventDefault();
            $.ajax({
                type: "get",
                url: '/edit',              
                dataType: "json",
                data : {
                    id : data_id,
                },         
                success: function (data) {
                    $('#input_id').val(data.id);
                    $('#input_nama').val(data.nama);
                    $('#input_keterampilan').val(data.keterampilan);
                    $('button').text('update data');
                }
            });
        };

    //update data
    $('form').submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         var CSRF_TOKEN = $('input[name="_token"]').attr('value');
         var id =  $('#input_id').val();
         var nama = $('#input_nama').val();
         var keterampilan =  $('#input_keterampilan').val();
          $.ajax({
              type: "post",
              url: "/update",
              data: {
                '_token' : CSRF_TOKEN,
                id : id,
                nama : nama,
                keterampilan : keterampilan,
              },
              dataType: "json",
              success: function (data) {
                window.location.reload();
                $('form').trigger("reset");
                
              }
          });

    })


</script>

</html>

//route
<?php
use Illuminate\Support\Facades\DB;
use App\profil;
use Illuminate\Http\Request;

Route::get('/', function(){
    $data_db =  profil::paginate(3);
    return view ('index', ['data_db'=> $data_db]);
});

Route::post('/post_data', function(Request $request){
    return profil::create($request->all());
 // return dd($request->all());
 //    return response()->json(['berhasil'=>'belajar lah lagi dengan giat sampai mati.']);
 });

//edit
Route::get('/edit', function(Request $request){
    $data_db = profil::find($request->id);
    return response()->json($data_db);    
});


Route::post('/update', function(Request $request){
    $data_db = profil::find($request->id);
   $data_db->update([
       'nama' => $request->nama,
       'keterampilan' => $request->keterampilan,
   ]);
   return response()->json(['pesan' => 'data berhasil diupdate']);
});
?>
