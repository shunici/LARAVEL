https://codepen.io/inzamam_57/pen/drLqrz
https://stackoverflow.com/questions/55356080/fullcalendar-locale-in-laravel-not-working/55357179


kadang tidak bisa..gunakan ini di kontroller

<?php

public function index()
      {
    	$agenda = agenda_kerja::get();
    	$agenda_list = [];
    	foreach ($agenda as $key => $event) {
    		$agenda_list[] = Calendar::event(
                $event->judul,
                true,
                new \DateTime($event->mulai_tgl),
                new \DateTime($event->akhir_tgl.' +1 day')
            );
    	}
    	$kalender_detail = Calendar::addEvents($agenda_list)->setOptions(['lang' => 'id']); 


/>
