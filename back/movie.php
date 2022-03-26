<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div style="overflow: auto;height:420px;">
    <?php
    $mos = $Movie->all(" ORDER BY rank");
    foreach ($mos as $key => $movie) {

        if ($key == 0) {
            $up = $movie['id'] . "-" . $movie['id'];
            $down = $movie['id'] . "-" . $mos[$key + 1]['id'];
        }

        if ($key == (count($mos) - 1)) {
            $up = $movie['id'] . "-" . $mos[$key - 1]['id'];
            $down = $movie['id'] . "-" . $movie['id'];
        }

        if ($key > 0 && $key < (count($mos) - 1)) {
            $up = $movie['id'] . "-" . $mos[$key - 1]['id'];
            $down = $movie['id'] . "-" . $mos[$key + 1]['id'];
        }

    ?>

        <div style="display: flex;width:100%;">
            <div style="width: 10%;">
                <img src="img/<?= $movie['poster']; ?>" style="width: 100%;">
            </div>
            <div style="width: 10%;">
                分級
                <img src="icon/<?= $movie['level']; ?>.png" alt="">
            </div>
            <div style="width: 80%;">
                <div style="display: flex;">
                    <div style="width: 33%;">片名：<?= $movie['name']; ?></div>
                    <div style="width: 33%;">片長：<?= $movie['length']; ?></div>
                    <div style="width: 33%;">上映時間：<?= $movie['ondate']; ?></div>
                </div>
                <div style="text-align: right;">
                    <button class="show" data-id="<?= $movie['id']; ?>"><?= ($movie['sh'] == 1) ? '顯示' : '隱藏'; ?></button>
                    <button class="sw" data-sw="<?= $up; ?>">往上</button>
                    <button class="sw" data-sw="<?= $down; ?>">往下</button>
                    <button onclick="location.href='?do=edit_movie&id=<?= $movie['id']; ?>'">編輯電影</button>
                    <button onclick="del('movie','<?= $movie['id']; ?>')">刪除電影</button>
                </div>
                <div>
                    劇情介紹：<?= $movie['intro']; ?>
                </div>
            </div>
        </div>
        <hr>
    <?php
    }
    ?>
</div>

<script>
    $('.sw').on("click", function() {
        let id = $(this).data("sw").split("-", );
        // console.log(id);
        $.post("api/sw.php", {
            id,
            table: "movie"
        }, () => {
            location.reload();
        })
    })

    $(".show").on("click", function() {
        let id = $(this).data("id");
        $.post("api/show.php", {
            id
        }, () => {
            location.reload();
        })
    })
</script>