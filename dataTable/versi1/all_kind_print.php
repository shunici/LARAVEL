harap sudah install yajra, jessengers, 
//data.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            background-color: grey;
        }
    </style>
    <title>datatable from shuni</title>


   <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


</head>
<body>
    <h1 class="text-center">Data Profil Muhammad Noviyanur</h1>
    
   <div class="container">
       <div class="row">
           <div class="col-md-12">
            <table class="table table-bordered" id="users-table">
                <thead>               
                 <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>keterampilan</th>
                    <th>intro</th>
                    <th>dibuat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
        
                </tbody>
            </table>
        
           </div>
       </div>
   </div>

   
   <script src="{{url('js/jquery.min.js')}}" ></script>
   <!-- ini untuk bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" ></script>
   <script src="{{url('js/bootstrap.min.js')}}"></script>
   <!-- end bootstrap -->

   <!-- ini untuk datatables -->
   <script src="{{url('js/jquery.dataTables.min.js')}}"></script>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


    <script>
       $(document).ready(function(){
        $('#users-table').DataTable({
            processing : true,
            serverside : true,
            ajax : '{{route('data-index')}}',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json"
            },
            columns : [
                {data : 'no', name : 'no'},
                { data : 'nama', name : 'nama'},
                {data : 'keterampilan', name: 'keterampilan'},
                {data : 'intro', name : 'intro'},
                {data : 'created_at', name : 'created_at'},
                {data : 'action', name : 'action', orderable : false, searchable:false, printable:false}
              
            ],
            dom: 'Bfrtip',
            buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
               
                messageBottom: null
            }
        ]     
         
            
        })

       })

        </script>  
     
</body>

</html>
//route

Route::get('/', 'dataController@index')->name('data-index');

Route::get('shun/{id}', function(){
    return 'tesss';
});

//controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\profil;
use Yajra\Datatables\Datatables;
use Jenssegers\Date\Date;

use Carbon\Carbon;
class dataController extends Controller
{
    public function index (Request $request)
   
    {
     Date::setLocale('id');
     if ($request->ajax()){
         $users = profil::select(['id', 'nama', 'keterampilan', 'created_at'])->get();
         $no = 1;
         return Datatables::of($users)
             ->addColumn('action', function ($user) {
                 return '<a href="shun/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
             })
             ->editColumn('no', $no++)
             ->editColumn( 'nama', 'ronaldo {{$nama}}') 
 
             ->editColumn('created_at', function ($user) {
                 return  Date::parse($user->created_at)->format('l, j F Y');
             })
             ->addColumn('intro', 'wahai {{ $nama }}!')        
             ->toJson();
             
     }
    
     return view ('data');
    }
 



}
