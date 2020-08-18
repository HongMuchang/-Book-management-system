<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style/style.css'>

    <title>登録画面</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="form">
                <form method="POST" action="update_do.php" 　>
                    <div class="card-header text-center">
                        <h1>単行本情報変更</h1>
                    </div>
                    <div class="card-body">
                        <div class="">

                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $result['id']; ?>">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $result['title'];?>"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="volume">巻数</label>
                            <input type="text" class="form-control" name="volume"
                                value="<?php echo $result['volume'];?>" required />
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="text" class="form-control" name="price" value="<?php echo $result['price'];?>"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="release_date">発売日</label>
                            <input type="text" class="form-control" name="release_date"
                                value="<?php echo date('Ymd', strtotime($result['release_date']));?>" required />
                        </div>
                        <div class="form-grop">
                            <label for="purchase_date">購入日</label>
                            <input type="text" class="form-control" name="purchase_date"
                                value="<?php echo changeNull($result['purchase_date']);?>" />
                        </div>
                        <button type="submit" class="btn btn-primary">変更</button>
                        <a href="list.php">一覧ページ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>