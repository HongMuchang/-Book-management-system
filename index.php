<?php
/**
 * --------------------------------------------------------------------
 * ----------------------------[insert関数]-----------------------------
 * --------------------------------------------------------------------
 * 説明:INSERT文で追加
 * @access public
 * [引数]
 * @param  string  $sql  第一引数:INSERT文
 * @param  string  $name 第二引数:データベースの追加したい項目
 * @param  int     $age  第三引数:データベースの追加したい項目
 * @param  string  $ext  第四引数:データベースの追加したい項目
 * [戻値]
 * @return               戻り値:なし
 * --------------------------------------------------------------------
 * ----------------------------[getAll関数]-----------------------------
 * --------------------------------------------------------------------
 * 説明:全件の取得
 * @access public
 * [引数]
 * @param               引数  :なし
 * [戻値]
 * @return              戻り値: $result(DB情報全件)
 * --------------------------------------------------------------------
 * ----------------------------[maxId関数]-----------------------------
 * --------------------------------------------------------------------
 * 説明:全件の取得
 * @access public
 * [引数]
 * @param               引数  :なし
 * [戻値]
 * @return              戻り値: $result(IDの最大値)
 * --------------------------------------------------------------------
 * ----------------------------[getId関数]------------------------------
 * --------------------------------------------------------------------
 * 説明:特定のIDの取得
 * @access public
 * [引数]
 * @param  int    $id     第一引数:取得したいID
 * [戻値]
 * @return        $result 戻り値  :特定のIDの取得
 * --------------------------------------------------------------------
 * ---------------------------[delete関数]------------------------------
 * --------------------------------------------------------------------
 * 説明:特定のIDの削除
 * @access public
 * [引数]
 * @param  int    $id     第一引数:削除したいID
 * [戻値]
 * @return        $result 戻り値  :なし
 * --------------------------------------------------------------------
 * ----------------------------[update関数]-----------------------------
 * --------------------------------------------------------------------
 * 説明:特定のIDの更新
 * @access public
 * [引数]
 * @param  int    $id     第一引数:更新したいID
 * [戻値]
 * @return        $result 戻り値  :なし
 * --------------------------------------------------------------------
 */
//読み込み
require_once "./dbconnect.php";

class Dbc implements DBconnect 
{

    const UTF = 'utf8';
    protected $table_name;
    function __construct($table_name)
    {
        $this->table_name = $table_name;
    }
    
    //---------------------------------
    //DB接続
    //---------------------------------
    public function pdo()
    {
        $dsn = "mysql:dbname=" . self::D . ";host=" . self::H . ";charset=" . self::UTF;
        $user = self::U;
        $pass = self::P;
        try {
            return $pdo = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . SELF::UTF));
        } catch (Exception $e) {
            echo '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：103)' . $e->getMesseage;
            die();
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //エラーを表示してくれる。
        return $pdo;
    }
    //---------------------------------
    //全件取得
    //---------------------------------
    public function getAll()
    {
        $pdo = $this->pdo();
        $sql = "SELECT * FROM $this->table_name WHERE del_date IS NULL  ORDER BY release_date DESC";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //---------------------------------
    //特定のIDの取得
    //---------------------------------
    public function getId($id)
    {
        $pdo = $this->pdo();
        $stmt = $pdo->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //---------------------------------
    //ID最大値取得
    //---------------------------------
    public function maxId()
    {
        $pdo = $this->pdo();
        $stmt = $pdo->prepare("SELECT MAX(id) FROM $this->table_name");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //---------------------------------
    //DBに追加:insert関数
    //---------------------------------
    public function insert($sql, $title, $volume, $price,$release_date,$purchase_date)
    {
        $pdo = $this->pdo();
        $stmt = $pdo->prepare($sql);
        $pdo->beginTransaction(); //トランザクション開始
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':volume', $volume, PDO::PARAM_INT);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':release_date', $release_date, PDO::PARAM_STR);
            $stmt->bindValue(':purchase_date', $purchase_date, PDO::PARAM_STR);
            $stmt->execute();
            $result = $pdo->commit(); //トランザクション成功
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack(); //トランザクション失敗
            echo '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：104)' . $e->getMessage();
            exit();
        }
    }

    //---------------------------------
    //削除
    //---------------------------------
    public function delete($id)
    {
        $now = date('Y-m-d');
        $pdo = $this->pdo();
        $stmt = $pdo->prepare("UPDATE $this->table_name SET del_date=:del_date WHERE id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->bindValue(':del_date',$now, PDO::PARAM_STR);
        $result = $stmt->execute();
        //結果を取得
        return $result;
    }
    //---------------------------------
    //更新
    //---------------------------------
    public function update($id)
    {
        $pdo = $this->pdo();
        $stmt = $pdo->prepare("UPDATE $this->table_name SET title=:title,volume=:volume,price=:price,release_date=:release_date,purchase_date=:purchase_date WHERE id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
        $stmt->bindValue(':volume', $_POST["volume"], PDO::PARAM_INT);
        $stmt->bindValue(':price', $_POST["price"], PDO::PARAM_INT);
        $stmt->bindValue(':release_date', $_POST["release_date"], PDO::PARAM_STR);
        if(empty($_POST["purchase_date"])){ //null値の追加
            $stmt->bindValue(':purchase_date',null);
        }else{
            $stmt->bindValue(':purchase_date',$_POST["purchase_date"], PDO::PARAM_STR);
        }

        
        $result = $stmt->execute();
        return $result;
    }
    

}
//---------------------------------
//nullの時空で表示(UP,DE)
//---------------------------------
function changeNull($POST){
    if($POST===null){
        $result="";
        return $result;
    }else{
        $result= date('Ymd', strtotime($POST));
        return $result;
    }
}