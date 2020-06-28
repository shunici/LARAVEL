//posisi di controlller

format rupiah uang duit php di controller
 private function rupiah($angka)
    {
         $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
       
    }
   
 public function index()
 {
  echo $this->rupiah(10000);
  //hasil Rp. 10.000,-
 }
