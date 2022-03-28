<?php 
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];

// 時間不是今天且dateG(小時)<14，就是有5場
if($date!=date("Y-m-d") || date("G")<14){
    $s=5;
}else{
    // 不然s就等於
    $s=5-ceil((date("G")-13)/2);
}


for($i=(6-$s);$i<=5;$i++){
    // 計算剩餘座位，條件是電影名、上映日期、場次
    $seats=$Ord->math('sum','qt',['movie'=>$movie['name'],'date'=>$date,'session'=>$ss[$i]]);
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 ".(20-$seats)."</option>";
}