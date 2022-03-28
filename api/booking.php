<?php
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];
$session=$ss[$_GET['session']];

$ords=$Ord->all(['movie'=>$movie['name'],'date'=>$date,'session'=>$session]);
$seats=[];
foreach($ords as $ord){
   $seats=array_merge($seats,unserialize($ord['seat']));
}
?>

<style>
#seats {
    display: flex;
    flex-wrap: wrap;
    width:540px;
    height:370px;
    padding:19px 112px 12px 112px;
    /* ↑不加底部的12px，就要用align-content:start; */
    margin:auto;
    background:url('icon/03D04.png');
    box-sizing:border-box;
    /* ↑不加這個我們設的padding就是外擴而不是內吃了 */
}

.seat {
    width: 63px;
    height: 85px;
    position:relative;
    /* ↑這要設relative，checkbox的absolute才會起作用 */
}

.null{
    background:url('icon/03D02.png');
    background-position:center;
    background-repeat:no-repeat;
}

.booked{
    background:url('icon/03D03.png');
    background-position:center;
    background-repeat:no-repeat;
}


.check{
    position:absolute;
    right:5px;
    bottom:5px;
}
</style>

<div id="seats">
    <?php

    for($i=0;$i<20;$i++){
        $booked=in_array($i,$seats)?'booked':'null';
        echo "<div class='seat $booked'>";
        echo "  <div class='ct'>";
        echo    (floor($i/5)+1). "排".($i%5 +1)."號";
        echo "  </div>";
        if(!in_array($i,$seats)){
            echo "<input type='checkbox' name='check' class='check' value='$i'>";
        }
        echo "</div>";
    }
    ?>
</div>

<div style="width:540px;margin:auto">
    <div>您選擇的電影是：<?=$movie['name'];?></div>
    <div>您選擇的時刻是：<?=$date;?> <?=$session;?></div>
    <div>您已經勾選了<span id="tickets"></span>張票，最多可以購買四張票</div>
    <div>
        <button onclick="prev()">回上一步</button>
        <button onclick="order()">完成訂購</button>
    </div>
</div>

<script>
let seats=new Array();

$(".check").on('click',function(){
    if($(this).prop('checked')){
        if(seats.length<4){
            seats.push($(this).val())
        }else{
            alert("最多只能勾選四張票")
            // 超過4個就不能再讓第5個狀態是true↓↓↓
            $(this).prop('checked',false)
        }
    }else{
        // 如果點下去是false的狀況(比如說點2次)，就從陣列裡刪除，下方的1是指刪掉一個就好
        // 所有js的陣列都是物件，所以下方用點，seats.陣列中哪個，的形式
        // indexOf(值)裡裝值，去取那個值的索引
        // splice(陣列，起始鍵值，刪幾個)
         seats.splice(seats.indexOf($(this).val()),1);
    }
    // ↓↓↓去更新您已經勾選了幾張票
    $("#tickets").text(seats.length)
})


function order(){
    let order={id:$("#movie").val(),
               date:$("#date").val(),
               session:$("#session").val(),
               seats}
    // 我們送到後端的東西包含陣列seats，用get沒辦法送，而且涉及改變資料表的東西一般用post
    $.post('api/order.php',order,(result)=>{
        $("#mm").html(result)
    })
}
</script>