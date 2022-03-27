<style>
/* 先宣告class lists底下的所有元素
 * 都以border-box的模式來設定
 * 可以減少因為邊框及間距帶來的寬度不易計算問題
 */
.lists *,
.controls *{
  box-sizing:border-box;
}

.lists{
  width:210px;
  height:260px;
  margin:auto;
  overflow:hidden;
  position:relative;
}
.lists .po{
  width:100%;
  text-align:center;
   /*先預設所有的海報都是隱藏的*/
  display:none;
  /*設定position才能讓元素擁有畫面上的坐標位置
     * 之後才能以js來對位置進行控制
     * absolute的上層一定會抓一個relative，所以lists是relative
     */
  position:absolute;
}
.po img,
.icon img{
  width:100%;
  /*   同是100%，po的img是210px，icon的img則是80px   */
  border:2px solid white;
}

/* ↓下方海報們及左右按鈕的家 */
.controls {
    display: flex;
    margin: auto;
    width: 100%;
    align-items:center;
    /*   ↑維持成員們垂直置中   */
    justify-content:space-evenly;
    /*   ↑橫向成員們的空間是平均的   */
}

/* 海報們的家，控制一次顯示4張所以寬度是80X4=320 */
.icons {
    display: flex;
    width: 320px;
    height: 110px;
    overflow:hidden;
    font-size:12px;
}
.icon{
  width:80px;
  /*   ↓這超重要，子元素告訴父元素它不想被縮   */
  flex-shrink:0;
  padding:5px;
  position:relative;
}
.left {
    border-top:20px solid transparent;
    border-right:25px solid black;
    border-bottom:20px solid  transparent;
    /* border-left:25px solid  transparent; */
    /*   以上四行讓div變成◤   */
    cursor: pointer;
}

.right {
  border-top:20px solid transparent;
    /* border-right:25px solid transparent; */
    border-bottom:20px solid  transparent;
    border-left:25px solid  black;
    /*   以上四行讓div變成◢   */
    cursor: pointer;
}

.left:hover{
  border-right:25px solid #555;
}
.right:hover{
  border-left:25px solid  #555;
}
</style>

<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div>
          <div class="lists">
            <?php
              $pos=$Poster->all(" where `sh`=1 Order By `rank`");
              foreach ($pos as $key => $po) {
                echo "<div class='po' data-ani='{$po['ani']}'>";
                echo "<img src='img/{$po['path']}'>";
                echo $po['name'];

                echo "</div>";
              }

            ?>
          </div>

          <div class="controls">
            <div class="left"></div>
            <div class="icons">
              <?php
              foreach ($pos as $key => $po) {
                echo "<div class='icon' data-ani='{$po['ani']}'>";
                echo "<img src='img/{$po['path']}'>";
                echo $po['name'];
                echo "</div>";
              }
              ?>
            </div>
            <div class="right"></div>
          </div>
        </div>
      </div>
    </div>
<script>
    // ↓預設上面大海報先秀第一張
$(".po").eq(0).show();
// 若海報有8長，則陣列長度為8，鍵值為0~7
let i=0;
let all=$('.po').length; 


let slides=setInterval(() => {
    i++;
    // i為鍵值，大於8-1時，就歸零重來
    if(i>all-1){
      i=0;
    }
    ani(i);

}, 2500);


// 轉場函式
function ani(n){
    // ani是我們插標的，每張海報(n)的動畫類型(ani)
  let ani=$(".po").eq(n).data('ani');
//   ★★★重點是這個，我們用到$(".po:visible")去抓現正顯示的海報
  let now=$(".po:visible")
//   設定下一個是n，那正顯示的就自動歸為n-1喔
  let next=$(".po").eq(n)

  switch(ani){
    case 1:
      //淡入淡出
      now.fadeOut(1000);
    //   要給正顯示的退場動畫用淡出及時間↑↑↑
    // 給下個顯示的進場動畫用淡入及時間↓↓↓
    // 總時間為2.5秒，所以以上2個共扣掉2秒，還綽綽有餘
      next.fadeIn(1000);
    break;
    case 2:
    //縮放
    /* 如果縮小和放大同時執行的話，會讓畫面變得奇怪
             * 所以利用anmiate本身的回呼函式，讓動畫在
             * 前一張海報的縮小完成後再執行放大的動畫
             */
    now.hide(1000,function(){
      next.show(1000);
    });
    break;
    case 3:
      //滑入滑出
      now.slideUp(1000,function(){
        next.slideDown(1000);
      });
    break;
  }
}

// 左右鈕
// p可想成是按幾下
let p=0;
$(".left,.right").on("click",function(){
    // 左鈕的情形，p如果>=1，也就是至少有2張(p=0、1)的話，就可啟動往左滑
    if($(this).hasClass('left')){
      if(p-1>=0){
        p--;
      }

    }else{
        // 如果是8張就是p<=3，p可按0123共4下
      if(p+1<=all-4){
        p++;
      }
    }

    $(".icon").animate({right:p*80},500)
})

// 當點到其中一張小海報時，中斷輪播並播放這張登場動，且啟動由這張開始的新一輪輪播
$(".icon").on("click",function(){
    // 停止輪播動畫
  clearInterval(slides)
//   抓到這張的索引值
  let idx=$(this).index()
//   啟動由這張開始的ani函式，讓這張海報登場
  ani(idx)

//   將這張索引值指配給i
  i=idx

//   我們要啟動由這張開始的輪播，一直輪播下去
  slides=setInterval(() => {
    i++;
    if(i>all-1){
      i=0;
    }
    ani(i);
}, 2500);
})
</script>    