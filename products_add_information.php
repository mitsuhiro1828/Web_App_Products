<?php
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=localhost;dbname=order;',
        // ユーザー名
        'root',
        // パスワード
        '',
        // レコード列名をキーとして取得させる
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );
    $user_id = $_GET["user_id"];
    $password = $_GET["password"];
?>

<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body></body>
    <div>
        <form action="products_add.php" method="get">
        <p>・種別</p>
        <p>
        <input type="radio" name="type" value="1" checked="checked">書籍
        <input type="radio" name="type" value="2">サプライ品
        <input type="radio" name="type" value="3">ドローン
        <input type="radio" name="type" value="4">DVD
        <input type="radio" name="type" value="5">ゲーム
        </p>
        <p>
        <input type="radio" name="type" value="6">家電
        <input type="radio" name="type" value="7">カメラ
        <input type="radio" name="type" value="8">AV機器
        <input type="radio" name="type" value="9">パソコン
        <input type="radio" name="type" value="10">オフィス機器
        </p>
        <p>
        <input type="radio" name="type" value="11">食品・飲料
        <input type="radio" name="type" value="12">お酒
        <input type="radio" name="type" value="13">DIY
        <input type="radio" name="type" value="14">ペット
        <input type="radio" name="type" value="15">ビューティー
        </p>
        <p>
        <input type="radio" name="type" value="16">おもちゃ
        <input type="radio" name="type" value="17">服
        <input type="radio" name="type" value="18">スポーツ
        <input type="radio" name="type" value="19">車
        </p>

        <p>・商品名</p>
        <p><input type="name" name="name" placeholder="商品名" value=""></p>

        <p>・値段</p>
        <p><input type="price" name="price" placeholder="値段" value=""></p>

        <p>・発注日</p>
        <p><input type="date" name="order_date" value=""></p>

        <p>・商品状態</p>
        <p>
        <input type="radio" name="order_status" value="1" checked="checked">発注済

        <input type="radio" name="order_status" value="2">納品済
        <input type="radio" name="order_status" value="3">未発送
        <input type="radio" name="order_status" value="4">返品
        </p>
        <?php
        echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
        echo '<input type="hidden" name="password" value="'.$password.'">';
        ?>
        

        <p>・納品日</p>
        <p><input type="date" name="delivery_date" value=""></p>
        
        <p><input type="submit" value="送信"></p>


    <div>
    </form>



</html>