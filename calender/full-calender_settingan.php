versi 7 laravel madhatter tidak bisa
https://stackoverflow.com/questions/61223570/moving-from-laravel-5-8-to-7x-errors-with-maddhatter-laravel-fullcalendar
https://github.com/nelkasovic/laravel-full-calendar


//stepnya dibawah ini

//composer require qlick/laravel-full-calendar
<?php 
'providers' => [
	....
	....
	LaravelFullCalendar\FullCalendarServiceProvider::class,
],
 
'aliases' => [
	....
	....
	'Calendar' => LaravelFullCalendar\Facades\Calendar::class,
]

	//

	//dibawah ini belum ada jquerynya tambahkan yaaa
	
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>
<body>
    
    <div class="panel panel-primary">
        <div class="panel-heading">MY Event Details</div>
        <div class="panel-body" >
          {!! $kalender_detail->calendar() !!}
          {!! $kalender_detail->script() !!}
        
        </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>
</body>
</html>
