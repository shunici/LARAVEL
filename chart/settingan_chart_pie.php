<?php


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script>        
        var kategori = <?php echo $kategori; ?>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart(){
        var data = google.visualization.arrayToDataTable(kategori);
        var options = {
        title : 'Persentase Kategori Cetakan',
        is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('kategori_pie'));
        chart.draw(data, options);
        }

     </script>

</head>
<body>
    //ini di bladenya
    <div id="kategori_pie" style="width:500px; height:350px;"></div>

</body>
</html>

//controller

$kategori_cetakan = DB::table('transaksis')
->select(
    DB::raw('kategori_cetakan as kategori_cetakan'),
    DB::raw('count(*) as number'))
->groupBy('kategori_cetakan')
->get();
$array_kategori[] = ['kategori_cetakan', 'Number'];
foreach($kategori_cetakan as $key => $value){
$array_kategori[++$key] = [$value->kategori_cetakan, $value->number];
}

          
return view('home', compact(           
    'agenda_kerja'          
), [    
    'kategori' => json_encode($array_kategori)       
]
);


//routenya seperti biasa




?>
