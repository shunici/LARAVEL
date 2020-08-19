https://stackoverflow.com/questions/3045619/how-to-store-values-from-foreach-loop-into-an-array
<?php
// simpan array pada foreach dengan variabel
$items = array();
foreach($group_membership as $username) {
 $items[] = $username;
}
print_r($items);

//jika kita ingin menampilkan satu saja (terakhir record) didalam username itu  maka seperti ini

$items = '';
foreach($group_membership as $username) {
 $items = $username;
}
print_r($items);
