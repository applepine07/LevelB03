<?php
include_once "../base.php";
if (isset($_FILES['trailer']['tmp_name'])) {
    $_POST['trailer'] = $_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../img/" . $_POST['trailer']);
}
if (isset($_FILES['poster']['tmp_name'])) {
    $_POST['poster'] = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], "../img/" . $_POST['poster']);
}

$_POST['ondate'] = join("-", [$_POST['year'], $_POST['month'], $_POST['day']]);
$_POST['rank'] = $Movie->math('max', 'id') + 1;
$_POST['sh'] = 1;

unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);

$Movie->save($_POST);
// dd($_POST);

to("../back.php?do=movie");
