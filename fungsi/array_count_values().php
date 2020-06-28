https://stackoverflow.com/questions/11646054/php-count-specific-array-values
menghitung variabel dalam array mempunyai values yang sama

$array = array("Kyle","Ben","Sue","Phil","Ben","Mary","Sue","Ben");
$counts = array_count_values($array);
echo $counts['Ben'];


