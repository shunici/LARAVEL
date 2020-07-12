versi 7 laravel madhatter tidak bisa
https://stackoverflow.com/questions/61223570/moving-from-laravel-5-8-to-7x-errors-with-maddhatter-laravel-fullcalendar

// composer require laravel-fullcalendar
<php 
'providers' => [
	....
	....
	MaddHatter\LaravelFullcalendar\ServiceProvider::class,
],
 
'aliases' => [
	....
	....
	'Calendar' => MaddHatter\LaravelFullcalendar\Facades\Calendar::class,
]
