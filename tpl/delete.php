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
            <div class="card-header text-center">
                <h1>単行本削除</h1>
            </div>
            <div class="form">
                <form action="delete_do.php" method="POST">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $result['id']; ?>">
                    <table class="">
                        <tr>
                            <th>タイトル</th>
                            <td><?php echo $result["title"]; ?></td>
                        </tr>
                        <tr>
                            <th>巻数</th>
                            <td><?php echo $result["volume"]; ?>巻</td>
                        </tr>
                        <tr>
                            <th>価格</th>
                            <td><?php echo $result["price"]; ?>円</td>
                        </tr>
                        <tr>
                            <th>発売日</th>
                            <td><?php echo date('Y年n月j日', strtotime($result["release_date"])); ?></td>
                        </tr>
                        <tr>
                            <th>購入日</th>
                            <td>
                                <?php if($result["purchase_date"]===null):?>
                                <?php echo $result["purchase_date"]="-"?>
                                <?php else:?>
                                <?php echo date('Y年n月j日', strtotime($result["purchase_date"])); ?>
                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">削除</button>
            </div>

            </form>

        </div>

    </div>
</body>

</html>