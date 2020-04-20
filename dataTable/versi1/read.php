<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">    
       <br />
       <h3 align="center">How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</h3>
       <br />
       <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Buat Data</button>
       </div>
       <br />
     <div class="table-responsive">
      <table id="user_table" class="table table-bordered table-striped">
       <thead>
        <tr>
         <th width="35%">Nama</th>
                  <th width="35%">Keterampilan</th>
                  <th width="30%">Action</th>
        </tr>
       </thead>
      </table>
     </div>
     <br />
     <br />
    </div>
   </body>
<script>

</script>
</html>
<script>
    
$(document).ready(function(){
         $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('profil-index') }}",
        },
        columns: [
        {
            data: 'nama',
            name: 'nama'
        },
        {
            data: 'keterampilan',
            name: 'keterampilan'
        },
        {
            data: 'aksi',
            name: 'aksi',
            orderable: false
        }
        ]
        });   
});



</script>

route//
<?php
use Illuminate\Support\Facades\Route;
Route::get('/profil', 'profilController@index')->name('profil-index');
?>

//controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\profil;

class profilController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = profil::latest()->get();
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }
        return view('index');
    }
}

?>

//jangan lupa modelnya buat sendiri

//untuk data base buat sendiri dengan fiele nama dan keterampilan
//sedangkan untuk settingan datatable bisa mengunjungi situs resminya

