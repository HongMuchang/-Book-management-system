<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style/style.css'>

    <title>一覧画面</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <table class="table" border="2">
                <h2 class="h2_title">登録一覧</h2>
                <div class="card-header text-center">
                    <tr>
                        <th>タイトル</th>
                        <th>巻数</th>
                        <th>価格</th>
                        <th>発売日</th>
                        <th>購入日</th>
                        <th class="bettween">編集</th>
                        <th class="bettween">削除</th>

                    </tr>
                </div>

                <?php foreach ($all as $value) : ?>
                <!---------全てのデータの表示 --------->
                <tr>
                    <td><?php echo $value["title"]; ?></td>
                    <td><?php echo $value["volume"]; ?>巻</td>
                    <td><?php echo $value["price"]; ?>円</td>
                    <td><?php echo date('Y年n月j日', strtotime($value["release_date"])); ?></td>
                    <td>
                        <?php if($value["purchase_date"]===null):?>
                        <?php echo "ー"; ?>
                        <?php else:?>
                        <?php echo date('Y年n月j日', strtotime($value["purchase_date"])); ?>
                        <?php endif;?>
                    </td>

                    <td class="bettween">
                        <!-- 編集 -->
                        <p><a class="green" href="update.php?id=<?php echo $value['id']; ?>">編集する</a></p>
                    </td>
                    <!-- 削除 -->
                    <td class="bettween">
                        <p><a class="red" href="delete.php?id=<?php echo $value['id']; ?>">削除</a></p>
                    </td>
                </tr>
                <?php endforeach; ?>


            </table>
        </div>
        <a href="insert.php">
            <button type="submit" class="btn btn-primary">単行本登録
            </button>
        </a>
    </div>
</body>

</html>