<?php include_once "../base.php";

$movie=$Movie->find($_POST['id']);
$date=$_POST['date'];
$session=$ss[$_POST['session']];
// 以下2行不能只用這一行$seats=sort($_POST['seats']);取代
// 因為sort會改變陣列內容但不會回傳陣列本身，所以會是把空值指派給變數$seats了
sort($_POST['seats']);
$seats=$_POST['seats'];
$id=$Ord->math("max","id")+1;
$no=date("Ymd") . sprintf("%04d",$id);
// 要用0開頭然後4位數，是digital的形式

$Ord->save([
    'no'=>$no,
    'movie'=>$movie['name'],
    'date'=>$date,
    'session'=>$session,
    'seat'=>serialize($seats),
    // ↑↑↑serialize協助將陣列轉成字串
    'qt'=>count($seats)
]);

?>

<!-- 以下是要回傳到前端#mm的內容，從order那貼過來 -->
<style>
    #order{
        width:60%;
        margin:auto;
    }
    .row{
        display:flex;
        width:100%;
    }
    .row .first{
        width:20%;
        text-align:right;
    }
    .row .sec{
        width:85%;
        text-align:left;
    }
    .sec select{
        width:100%;
    }

</style>
<div id="order">
<div class="row">
    <div class="sec">
        感謝您的訂購，您的訂單編號是：<?=$no;?>
    </div>
    
</div>
<div class="row">
    <div class="first">電影名稱：</div>
    <div class="sec">
        <?=$movie['name'];?>
    </div>
</div>
<div class="row">
    <div class="first">日期：</div>
    <div class="sec">
        <?=$date;?>
    </div>
</div>
<div class="row">
    <div class="first">場次時間：</div>
    <div class="sec">
        <?=$session;?>
    </div>
</div>
<div class="row">
    <div class="sec">
        座位:<br>
        <?php
        foreach($seats as $seat){
           echo  (floor($seat/5)+1). "排".($seat%5 +1)."號";
           echo "<br>";
        }

        ?>
        共<?=count($seats);?>張電影票
    </div>
</div>
<div class="row">
    <div class="ct" style="width:100%">
        <button onclick="location.href='index.php'">確認</button>
    </div>
    
</div>
</div>