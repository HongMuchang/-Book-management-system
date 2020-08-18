<?php

//クラス読み込み
require("./index.php");

//---------------------------------
//DBに追加(バリデーション有)
//---------------------------------
if (!empty($_POST)) {

    if ($_POST["title"] === "") { //タイトル
        $error["title"] = 'blank';
    }
    if (!is_numeric($_POST["volume"])) { //巻数
        $error['volume'] = "number";
    }
    if (($_POST["volume"] == "")) {
        $error['volume'] = "blank";
    }
    if (!is_numeric($_POST["price"])) { //価格
        $error['price'] = "number";
    }
    if (($_POST["price"] == "")) {
        $error['price'] = "blank";
    }
    if (!is_numeric($_POST["release_date"])) { //発売日
        $error['release_date'] = "number";
    }
    if (($_POST["release_date"] == "")) {
        $error['release_date'] = "blank";
    }
    

    //$errorが空の時、つまりエラーがない時
    if (empty($error)) {
        
        if ($_POST["purchase_date"]=="") { //購入日空白の時nullにする
            $_POST['purchase_date'] = null;
        }
        $sql = "INSERT INTO m_book(title,volume,price,release_date,purchase_date) 
                VALUES(:title,:volume,:price,:release_date,:purchase_date) ";
        $dbc = new Dbc("m_book");
        $dbc->insert($sql, $_POST['title'], $_POST['volume'], $_POST['price'], $_POST['release_date'], $_POST['purchase_date']);
        
        header('Location:list.php');
        exit();
    }
}

//View読み込み
require("./tpl/insert.php");