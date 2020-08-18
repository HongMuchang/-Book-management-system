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
                <form method="post" action="insert.php" 　>
                    <div class="card-header text-center">
                        <h1>会員登録フォーム</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" name="title" placeholder="タイトル" />
                            <?php if (@$error['title'] === 'blank') : ?>
                            <p class="error">*タイトルを入力してください</p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="volume">巻数</label>
                            <input type="text" class="form-control" name="volume" />
                            <?php if (@$error['volume'] === 'blank') : ?>
                            <p class="error">*巻数を入力してください</p>
                            <?php endif; ?>
                            <?php if (@$error['volume'] === 'number') : ?>
                            <p class="error">*数字で入力してください</p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="text" class="form-control" name="price" />
                            <?php if (@$error['price'] === 'blank') : ?>
                            <p class="error">*価格を入力してください</p>
                            <?php endif; ?>
                            <?php if (@$error['price'] === 'number') : ?>
                            <p class="error">*数字で入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="release_date">発売日</label>
                            <input type="text" class="form-control" name="release_date" placeholder="例)20200101" />
                            <?php if (@$error['release_date'] === 'blank') : ?>
                            <p class="error">*発売日を入力してください</p>
                            <?php endif; ?>
                            <?php if (@$error['release_date'] === 'number') : ?>
                            <p class="error">*数字で入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="purchase_date">購入日</label>
                            <input type="text" class="form-control" name="purchase_date" placeholder="例)20200101" />

                        </div>
                        <button type="submit" class="btn btn-primary" name="signup">会員登録する</button>
                        <a href="list.php">一覧画面</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>