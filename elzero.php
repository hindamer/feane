<?php
$arr=['ab','cd','ef'];
echo '<pre>';
print_r($arr);
$arr1=['ac'=>1,'cd'=>2,'ef'=>4];
echo '<pre>';
print_r($arr1);
foreach($arr as $val){
    echo $val."<br>";
}
foreach($arr1 as $val=>$row){
    echo $val." ".$row. "<br>";
}