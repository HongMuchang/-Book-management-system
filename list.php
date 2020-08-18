<?php 
//クラス読み込み
require("./index.php");

//---------------------------------
//全件取得
//---------------------------------
$dbc = new Dbc("m_book");
$all=$dbc->getAll();

//view読み込み
require("./tpl/list.php"); 