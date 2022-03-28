<?php 
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
// strtotime是當天的0時0分0秒，以下統一用strtotime
$finaldate=strtotime("+2 days",strtotime($movie['ondate']));
// ↑↑↑上映日的加2天，比如說3/20+2等於3/22，就是3/20、3/21、3/22共三天
$gap=($finaldate-strtotime(date("Y-m-d")))/(60*60*24);
// 秒數→(60)→分鐘→(60)→小時→(24)→天
// 結束日等於今天的話，相減是0；最多會有三種情形0、1、2，所以以下迴圈最多跑三回

for($i=0;$i<=$gap;$i++){
    // i=0(今天)、1(明天)、2(後天)↓↓↓
    $date=date("Y-m-d",strtotime("+$i days"));
    $dateShow=date("m月d日 l",strtotime("+$i days"));
    echo "<option value='$date'>$dateShow</option>";
}