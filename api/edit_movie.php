<?php
/**
 * 編輯的功能api和新增幾乎是一樣的，所以可以直接複製過來使用，
 * 唯一的差別就排序值和顯示狀態在編輯這邊是不需要修改，
 * 所以可以刪除$_POST['rank']及$_POST['sh']兩個欄位不用變更
 * 換句話說，如果加上有沒有帶入$_POST['id']的判斷，
 * 其實新增電影和編輯電影是可以共用一支API的
 * if(isset($_POST['id'])){
 *   $_POST['rank']=$Movie->math('max','id')+1;
 *   $_POST['sh']=1;
 * }
*/

include_once "../base.php";
if (!empty($_FILES['trailer']['tmp_name'])) {
    $_POST['trailer'] = $_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../img/" . $_POST['trailer']);
}
if (!empty($_FILES['poster']['tmp_name'])) {
    $_POST['poster'] = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], "../img/" . $_POST['poster']);
}

$_POST['ondate'] = join("-", [$_POST['year'], $_POST['month'], $_POST['day']]);
$_POST['sh'] = 1;

unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);
// 其實有傳過來id，但因為不用改就不用拿出來處理，只要一併存回去就好
$Movie->save($_POST);
// dd($_POST);

to("../back.php?do=movie");
