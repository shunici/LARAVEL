 $page = array(
            'title' => 'Hello World',
            'template' => 'welcome',
        );    
  $page = (object)$page;
  echo $page->title;


// dengan array
$page = array([
            'nama' => 'Ronaldo',
            'asal' => 'portugal'     
        ],
        [
            'nama' => 'Messi',
            'asal' => 'argentina'     
        ]
                                  
         );    
         $page = (object)$page;
// yang harus dengan looping foreach
