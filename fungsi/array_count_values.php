https://stackoverflow.com/questions/11646054/php-count-specific-array-values
//menghitung variabel dalam array mempunyai values yang sama
<?php
$array = array("Kyle","Ben","Sue","Phil","Ben","Mary","Sue","Ben");
$counts = array_count_values($array);
echo $counts['Ben'];


//hati hati dengan division by zero. itu terjadi ketika count bernilai nol

// https://erroz.wordpress.com/2010/08/24/solusi-menghindari-error-division-by-zero/
//belum dapat solusinya tapi bisa dipakai dengan cara alternatif lain ya itu dengan cara pengkondisian
Division by zero 
  
