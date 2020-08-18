<?php

//クラス読み込み
require("index.php");

//---------------------------------
//更新
//---------------------------------
$id=$_POST['user_id'];//IDの取得

$_POST["release_date"]= date('Y-m-d', strtotime($_POST['release_date']));

if(empty($_POST['purchase_date'])){
    $_POST['purchase_date']===null;
}else{
    $_POST['purchase_date']= date('Y-m-d', strtotime($_POST['purchase_date']));
}
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

$dbc = new Dbc("m_book");
$result=$dbc->update($id);//送られたPOST情報で更新

//view読み込み
require("./tpl/update_do.php");