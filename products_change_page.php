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
    $product_id = $_GET["product_id"];
?>

<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body></body>
    <div>
        <form action="products_change.php" method="get">
        <p>・種別</p>
        <?php
        $stmt = $pdo->prepare('select * from products where product_id ='.$product_id);
        $stmt->execute();
        $result = $stmt->fetch();
        $type = $result["type"];
        $name = $result["name"];
        $price = $result['price'];
        $order_date = $result['order_date'];
        $order_status = $result['order_status'];
        $order_user = $result['order_user'];
        $delivery_date = $result['delivery_date'];

        $stmt = $pdo->prepare('select * from type');
        $stmt->execute();
        $result = $stmt->fetchAll();
        $cnt = 0;
        foreach($result as $val){
            if ($val["type_id"] == $type) {
                // product_idと同じならば初期値として checked="checked"を入れる
                echo "<input type='radio' name='type' value='".$val["type_id"]."' checked='checked'>".$val["name"]." ";
            } else {
                echo "<input type='radio' name='type' value='".$val["type_id"]."'>".$val["name"]." ";
            }
            $cnt += 1;
            if ($cnt % 5 == 0) {
                echo "<br>";
            }
        }

        echo "<p>・商品名</p>";
        echo "<p><input type='name' name='name' placeholder='商品名' value='".$name."'></p>";

        echo "<P>・値段</p>";
        echo "<p><input type='price' name='price' placeholder='値段' value='".$price."'></p>";

        echo "<p>・発注日</p>";
        echo "<p><input type='date' name='order_date' value='".$order_date."'></p>";

        echo "<p>・商品状態</p>";
        $stmt = $pdo->prepare('select * from status');
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $val) {
            if($val["status_id"] == $order_status) {
                echo "<input type='radio' name='order_status' value='".$val['status_id']."' checked='checked'>".$val['status']." ";
            } else {
                echo "<input type='radio' name='order_status' value='".$val['status_id']."'>".$val['status']." ";
            }
        }

        echo "<p>・納品日</p>";
        echo "<p><input type='date' name='delivery_date' value='".$delivery_date."'></p>";

        echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
        echo '<input type="hidden" name="password" value="'.$password.'">';
        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
        ?>

        <p><input type="button" value="変更"></p>
    </div>
    </form>
</html>
