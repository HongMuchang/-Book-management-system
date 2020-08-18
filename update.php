<?php 

//クラスの読み込み
require("index.php");

//---------------------------------
//更新元の情報表示
//---------------------------------
$id=$_GET['id'];//IDの取得
$dbc = new Dbc("m_book");
$result=$dbc->getId($id);//IDを基に情報を取得

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

//view読み込み
require("./tpl/update.php");