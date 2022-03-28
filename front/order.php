<h3 class='ct'>線上訂票</h3>
<style>
    #order{
        width:50%;
        margin:auto;
    }
    .row{
        display:flex;
        width:100%;
    }
    .row .first{
        width:15%;
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
    <div class="first">電影：</div>
    <div class="sec"><select name="movie" id="movie"></select></div>
</div>
<div class="row">
    <div class="first">日期：</div>
    <div class="sec"><select name="date" id="date"></select></div>
</div>
<div class="row">
    <div class="first">場次：</div>
    <div class="sec"><select name="session" id="session"></select></div>
</div>
<div class="row">
    <div class="ct" style="width:100%">
        <button onclick="booking()">確定</button>
        <button onclick="reset()">重置</button>
    </div>
    
</div>
</div>

<div id="booking" style="display:none"></div>
<script>
    // 雖然我們也可以用php的方式↓↓↓，但盡量前端就用前端，後端就用後端
    // let id=<?=$_GET['id']??0;?>;
let id=(new URL(location)).searchParams.get('id');
// 這裡的let id是全域變數喔↑↑↑
getMovies(id)

// 連動關鍵↓↓↓on change，當電影有改變的時候，就執行一次getDays函式，id是movie的value(我們設為該電影id)
$("#movie").on("change",()=>{getDays()})
$("#date").on("change",()=>{getSessions()})

function booking(){
    $("#order,#booking").toggle()

    let order={id:$("#movie").val(),
               date:$("#date").val(),
               session:$("#session").val()}
    $.get("api/booking.php",order,(booking)=>{
        $("#booking").html(booking)
    })
}

function reset(){
    // 這裡抓的id是全域變數
    getMovies(id)
}

// ↓↓↓給#booking的上一步按鈕用
function prev(){
    $("#order,#booking").toggle()
// prev()要加入清空#booking的內容，題目要求，不然就算toggle回#order，booking產生的東西仍會在
    $("#booking").html("");
}

// 畫面一載入就執行一次getmovies
function getMovies(id){
    $.get("api/get_movies.php",{id},(movies)=>{
        $("#movie").html(movies)
        // 執行getmovies後，就執行一次getDays，連動載入該電影及該電影日期
        getDays()
    })
}

function getDays(){
    let id=$("#movie").val();
    $.get("api/get_days.php",{id},(days)=>{
        $("#date").html(days)
        getSessions();
    })
}

function getSessions(){
    let id=$("#movie").val();
    let date=$("#date").val();
    $.get("api/get_sessions.php",{id,date},(sessions)=>{
        $("#session").html(sessions)
    })
}
</script>