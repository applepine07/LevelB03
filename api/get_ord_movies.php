<?php 
include_once "../base.php";

// 用group by movie
$movies=$Movie->q("select `movie` from `ord` Group by `movie`");
foreach($movies as $movie){
    echo "<option value='{$movie['movie']}'>{$movie['movie']}</option>";
}
