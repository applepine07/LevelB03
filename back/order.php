<h3 class="ct">訂單清單</h3>
<style>

.field,
.row{
    display:flex;
}
.field span,
.row span{
    flex:1;
    background:#eee;
    margin:0 1px;
    text-align: center;
}
.row span{
    background:white;
}
.list{
    height:400px;
    overflow:auto;
}
</style>
<div>
    快速刪除：
    <input type="radio" name="type" value="date">
    依日期
    <input type="text" name="date" id="date">

    <input type="radio" name="type" value="movie">
    依電影
    <select name="movie" id="movie"></select>
    <button onclick="qdel()">刪除</button>
</div>
<div class='field'>
    <span>訂單編號</span><span>電影名稱</span><span>日期</span><span>場次時間</span><span>訂購數量</span><span>訂購位置</span><span>操作</span>
</div>
<div class='list'>
<?php
$rows=$Ord->all(" Order by `no` DESC");

foreach($rows as $row){
    echo "<div class='row'>";
    echo "  <span>{$row['no']}</span>";
    echo "  <span>{$row['movie']}</span>";
    echo "  <span>{$row['date']}</span>";
    echo "  <span>{$row['session']}</span>";
    echo "  <span>{$row['qt']}</span>";
    echo "  <span>";
        $seats=unserialize($row['seat']);
        foreach($seats as $seat){
            echo  (floor($seat/5)+1). "排".($seat%5 +1)."號";
            echo "<br>";
         }
    echo "</span>";
    echo "  <span><button onclick='del(&#39;ord&#39;,{$row['id']})'>刪除</button></span>";
    echo "</div>";
    echo "<hr>";
}

?>

</div>

<script>
    $("#movie").load("api/get_ord_movies.php")


function qdel(){
    let type=$("input[name='type']:checked").val()
    let target
    switch(type){
        case 'date':
            target=$('#date').val()
        break;
        case 'movie':
            target=$('#movie').val()
        break;
    }
    let chk=confirm(`你確定要刪除${target}的所有訂單資料嗎?`)
    if(chk){
        $.post("api/qdel.php",{type,target},()=>{
            location.reload()
        })
    }
}
</script>