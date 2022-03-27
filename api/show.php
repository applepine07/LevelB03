<?php
include_once "../base.php";

// 依傳來的id將資料撈出來後，改sh再存回去
$movie=$Movie->find($_POST['id']);
// if($movie['sh']==1){
//     $movie['sh']=0;
// }else{
//     $movie['sh']=1;
// }

$movie['sh']=($movie['sh']+1)%2;

$Movie->save($movie);

?>