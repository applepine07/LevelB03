<?php
include_once "../base.php";
// 以傳過來的id為主去比對
foreach ($_POST['id'] as $key => $id) {
    // 有在del陣列裡就刪除
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $Poster->del($id);
    } else {
        // 沒有的話就撈出來更新後
        $po = $Poster->find($id);
        $po['name']=$_POST['name'][$key];
        $po['ani']=$_POST['ani'][$key];
        // $po['rank']=$_POST['rank'][$key];
        $po['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;

        // 再存回去
        $Poster->save($po);
    }
}

to("../back.php?do=poster");