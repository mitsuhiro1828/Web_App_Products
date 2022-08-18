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

    try{
        $stmt = $pdo->prepare('delete from products where product_id ='.$product_id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        // https://techacademy.jp/magazine/11609
        if(empty($result)) {
            header('Location:login_tpl.php?user_id='.$user_id.'&password='.$password.'');
        } else {
            header('Location:login_tpl.php?user_id='.$user_id.'&password='.$password.'');
        }
    
    } catch (PDOException $e) {
        // 例外は発生したら無視
        //require_once 'products_add_information.php';
    
        echo $e->getMessage();
    }





?>