//model
//profil.php

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profil extends Model
{
    protected $fillable = [
        'nama', 'keterampilan'
       ];
    protected $table ='profils';
}





//controller
dataController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\profil;

use Yajra\Datatables\Datatables;
use Jenssegers\Date\Date;

class dataController extends Controller
{
    public function index (Request $request)
   
    {
     Date::setLocale('id');
     if ($request->ajax()){
       if(!empty($request->from_date)){
        $data_base = profil::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        return Datatables::of($data_base) 
        ->editColumn('created_at', function ($data_base) {
            return  Date::parse($data_base->created_at)->format('l, j F Y');
        })->make(true);
           
       }else{
        $data_base = profil::get();
         }
         return Datatables::of($data_base)  
         ->editColumn('created_at', function ($data_base) {
            return  Date::parse($data_base->created_at)->format('l, j F Y');
        })->make(true);
           
     }
    
     return view ('data');
    }

}
//route
Route::get('/', 'dataController@index')->name('data-index');

Route::get('shun/{id}', function(){
    return 'tesss';
});

//blade
data.blade.php

<html>
    <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Laravel 5.8 - Daterange Filter in Datatables with Server-side Processing</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
           <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    </head>
    <body>
     <div class="container">    
        <br />
        <h3 align="center">Laravel 5.8 - Daterange Filter in Datatables with Server-side Processing</h3>
             
               <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <br />
                        <div class="row input-daterange">
                            <div class="col-md-4">
                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            </div>
                        </div>
                        <br />
                     <table class="table table-bordered" id="users-table">
                         <thead>               
                          <tr>
                             <th>id</th>
                             <th>nama</th>
                             <th>keterampilan</th>
                             <th>created at</th>  
                             <th>updated at</th>              
                          
                         </tr>
                         </thead>
                         <tbody>
                 
                         </tbody>
                     </table>
                 
                    </div>
                </div>
            </div>
     </div>
    </body>
   </html>
   
   <script>
   $(document).ready(function(){
    $('.input-daterange').datepicker({
     todayBtn:'linked',
     format:'yyyy-mm-dd',
     autoclose:true
    });
   
    load_data();
   
    function load_data(from_date = '', to_date = '')
    {
     $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url:'{{ route("data-index") }}',
       data:{from_date:from_date, to_date:to_date},
       
      },
      columns : [
                {data : 'id', name : 'id'},
                {data : 'nama', name : 'nama'},
                {data : 'keterampilan', name: 'keterampilan'},
                {data : 'created_at', name : 'created_at'},
                {data : 'updated_at', name : 'updated_at'}                        
              
            ],
     });
    }
   
    $('#filter').click(function(){
     var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();
     if(from_date != '' &&  to_date != '')
     {
      $('#users-table').DataTable().destroy();
      load_data(from_date, to_date);
     }
     else
     {
      alert('Both Date is required');
     }
    });
   
    $('#refresh').click(function(){
     $('#from_date').val('');
     $('#to_date').val('');
     $('#users-table').DataTable().destroy();
     load_data();
    });
   
   });
   </script>
