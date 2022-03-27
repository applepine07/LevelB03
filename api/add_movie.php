<?php
include_once "../base.php";
// 先處理預告片和海報
if (isset($_FILES['trailer']['tmp_name'])) {
    $_POST['trailer'] = $_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../img/" . $_POST['trailer']);
}
if (isset($_FILES['poster']['tmp_name'])) {
    $_POST['poster'] = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], "../img/" . $_POST['poster']);
}

// 用join將前端分散的年月日重組成資料表中的ondate欄位
$_POST['ondate'] = join("-", [$_POST['year'], $_POST['month'], $_POST['day']]);
$_POST['rank'] = $Movie->math('max', 'id') + 1;
$_POST['sh'] = 1;

// 再用unset刪掉，以讓整個$_POST符合並可以順利存入資料表
unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);

$Movie->save($_POST);
// dd($_POST);

to("../back.php?do=movie");
