<style>
    .movie-list * {
        box-sizing: border-box;
    }

    .movie-list {
        display: flex;
        flex-wrap: wrap;
    }

    .movie-list>div {
        width: 49%;
        margin: 0.5%;
        border: 1px solid white;
        border-radius: 8px;
    }
</style>

<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="movie-list">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            // $rows = [1, 2, 3, 4];
            $all=$Movie->math('count','*'," WHERE `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today'");
            $div=4;
            $pages=ceil($all/$div);
            $now=$_GET['p']??1;
            $start=($now-1)*$div;

            $rows = $Movie->all(" WHERE `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today' 
            ORDER BY `rank` 
            limit $start,$div");
            foreach ($rows as $key => $row) {

            ?>
                <div>
                    <div class="ct" style="font-size: 22px;">片名：<?=$row['name'];?></div>
                    <div style="display: flex;">
                        <div>
                            <img src="img/<?=$row['poster'];?>" style="width:60px">
                        </div>
                        <div>
                            <div>分級：
                                <img src="icon/<?=$row['level'];?>.png" style="width:25px;vertical-align:middle">
                                <?=$Movie->level($row['level']);?>
                            </div>
                            <div>上映日期：<?=$row['ondate'];?></div>
                        </div>
                    </div>
                    <div>
                        <button onclick="location.href='?do=intro&id=<?=$row['id'];?>'">電影簡介</button>
                        <button onclick="location.href='?do=order&id=<?=$row['id'];?>'">線上訂票</button>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
        <div class="ct">
            <?php
            if(($now-1)>=1){
                $prev=$now-1;
                echo "<a href='?p=$prev' style='color:white'> ";
                echo " < ";
                echo " </a>";
            }

            for($i=1;$i<=$pages;$i++){
                $size=($now==$i)?"18px":"16px";
                echo "<a href='?p=$i' style='font-size:$size;color:white;'> ";
                echo $i;
                echo " </a>";
            }

            if(($now+1)<=$pages){
                $next=$now+1;
                echo "<a href='?p=$next' style='color:white'> ";
                echo " > ";
                echo " </a>";
            }
            ?>
        </div>
    </div>
</div>