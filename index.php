<?php

try {
    $db_name = 'gs_db4';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM menu_table;');
$status = $stmt->execute();

//３．データ表示
$view = '';
$select = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .='<tr>';
        $view .='<td class="item_name"><label>'.$result['id'].'</td>';
        $view .='<td><div class="item_entry">'.$result['name'].'</label></td>';
        $view .='<td><div class="item_entry">'.$result['price'].'円</label></td>';
        $view .='</tr>';

        $select .= '<option value="'.$result['name'].'">'.$result['id'] . '：' .$result['name'] . '：' . $result['price'].'円'.'</option>' ;
    }
}

$kind = array();
$kind[1] = '1番席';
$kind[2] = '2番席';
$kind[3] = '3番席';
$kind[4] = '4番席';
$kind[5] = '5番席';
$kind[6] = '6番席';
$kind[7] = '7番席';
$kind[8] = '8番席';
$kind[9] = '9番席';
$kind[10] = '10番席';
$kind[11] = '11番席';
$kind[12] = '12番席';
?>

</html>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文画面</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>




<body>
    <div class="title">注文画面</div>
    <div class="hyoji">
    <div class="menu_all">
            <div class="subtitle">メニュー一覧</div>
            <table class="hyoji_table">
                    <tr>
                    <td class="item_name"><label>ID</td>
                    <td><div class="item_entry">料理名</label></td>
                    <td><div class="item_entry">値段</label></td>
                    </tr>
                    <?= $view ?>
            </table>
        </div>
    <div class="menu_all">
    <form id="contact" method="post" action="insert.php">
    <div class="subtitle">注文</div><br>
    <select name="name" class="item_entry" >
    <option value="" selected disabled>席番号</option>
      <?php foreach($kind as $i => $v){ ?>
        <option value="<?php echo $i ?>"><?php echo $v ?></option>
      <?php } ?>
    </select>
    <select name="url1" class="item_entry">
    <option  value="" selected disabled>select the menu</option>
    <?= $select ?>
    </select>
    <br>
    <textarea type="text" name="content" placeholder="comment" class="item_entry"></textarea><br />
    <input type="submit" value="登録" class="button">
    <br>

    </div>

    </form>
    </div>
    <div class="button_flex">
    <a href='select.php' class="jump">注文一覧</a><br>
    <a href="menu/index.php" class="jump">管理者メニュー</a>
    </div>
    </div>
    </div>


    
</body>


</script>
