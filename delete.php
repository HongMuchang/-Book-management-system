<?php 

//クラス読み込み
require("index.php");

$id=$_GET['id'];//IDの取得

//---------------------------------
//IDを基に一件取得
//---------------------------------
$dbc = new Dbc("m_book");
$result=$dbc->getId($id);

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

//view読み込み
require("./tpl/delete.php");
?>