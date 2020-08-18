<?php 

//クラス読み込み
require("index.php");

$id=$_POST["user_id"];//IDを取得

$dbc = new Dbc("m_book");
$result=$dbc->delete($id);//送られたPOST情報で更新

//view読み込み
require("./tpl/delete_do.php");