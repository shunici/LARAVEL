versi 7 laravel madhatter tidak bisa
https://stackoverflow.com/questions/61223570/moving-from-laravel-5-8-to-7x-errors-with-maddhatter-laravel-fullcalendar
https://github.com/nelkasovic/laravel-full-calendar


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
//tambah ini di head html
