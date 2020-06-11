ini digunakan untuk menghilangkan tanda koma titik dan karakter huruf pada tulisan dalam proses di php
<?php
$a = "1.43,23";
$b = preg_replace('/[.,]/', '', $a);
echo $b;
?>
//output 14323 
