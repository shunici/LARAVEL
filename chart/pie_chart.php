https://www.webslesson.info/2018/06/how-to-use-google-chart-api-in-laravel.html
<?php 
//database

 Schema::create('pelanggans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('status_plg')->nullable();
            $table->timestamps();
        });

//////

taruh ini di head
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  

//controller
  $data = DB::table('pelanggans')
            ->select(
                DB::raw('status_plg as status_plg'),
                DB::raw('count(*) as number'))
            ->groupBy('status_plg')
            ->get();
            $array[] = ['Status_plg', 'Number'];
            foreach($data as $key => $value){
            $array[++$key] = [$value->status_plg, $value->number];
            }
            
 return view('home', compact(), ['status_plg' => json_encode($array)];
 
 //route
 Route::get('/home', 'HomeController@index')->name('home');
 
 //blade
 
 walaupun di blade taruh ini di head menggunakan yield()
 <script>    
var analytics = <?php echo $status_plg; ?>

google.charts.load('current', {'packages':['corechart']});

google.charts.setOnLoadCallback(drawChart);

function drawChart(){
 var data = google.visualization.arrayToDataTable(analytics);
 var options = {
  title : 'Persentase Data Pelanggan'
 };
 var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
 chart.draw(data, options);
}

</script>
 
 memunculkan
 <div id="pie_chart" style="width:250px; height:150px;"></div>
