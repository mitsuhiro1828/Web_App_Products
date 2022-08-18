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
    try{
        $type = $_GET["type"];
        $name = $_GET["name"];
        $price = $_GET["price"];
        $order_date = $_GET["order_date"];
        $order_status = $_GET["order_status"];
        $delivery_date = $_GET["delivery_date"];
        $order_user = $_GET["user_id"];
        $password = $_GET["password"];

        $stmt = $pdo->prepare('select COUNT(*) from products');
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products_cnt = $result[0]["COUNT(*)"];
        $products_cnt = intval($products_cnt);
        $products_cnt += 1;


        $stmt = $pdo->prepare('insert into products(product_id, type, name, price, order_date, order_status, order_user, delivery_date)
                                values('.$products_cnt.', '.$type.', "'.$name.'", '.$price.', "'.$order_date.'", '.$order_status.', "'.$order_user.'", "'.$delivery_date.'")');
        
        
        /*
        $stmt->bindParm(':type', $type);
        $stmt->bindParm(':name', $name);
        $stmt->bindParm(':price', $price);
        $stmt->bindParm(':order_date', $order_date);
        $stmt->bindParm(':order_status', $order_status);
        $stmt->bindParm(':order_user', $order_user);
        $stmt->bindParm(':delivery_date', $delivery_date);
        */

        // SQL文を実行
        $stmt->execute();

        $result = $stmt->fetchAll();


        // https://techacademy.jp/magazine/11609
        if(empty($result)) {
            header('Location:login_tpl.php?user_id='.$user_id.'&password='.$password.'');
        } else {
            header('Location:products_add_information.php');
        }
    

    } catch (PDOException $e) {
        // 例外は発生したら無視
        //require_once 'products_add_information.php';
    
        echo $e->getMessage();
    }






?>