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
    $type = $_GET["type"];
    $name = $_GET["name"];
    $price = $_GET["price"];
    $order_date = $_GET["order_date"];
    $order_user = $_GET["user_id"];
    $order_status = $_GET["order_status"];
    $delivery_date = $_GET["delivery_date"];


    if ($delivery_date == null){
        $delivery_date = 'null';
    }

    
    try{
        $sql = 'update products set type='.$type.',name="'.$name.'",price='.$price.',order_date='.$order_date.',order_user="'.$order_date.'",order_status='.$order_status.',delivery_date='.$delivery_date.',where product_id='.$product_id;
        
        echo $sql;
        echo '<br>';
        echo '<br>';
        
        
        $stmt = $pdo->prepare('update products 
                                set type='.$type.',
                                name="'.$name.'",
                                price='.$price.',
                                order_date="'.$order_date.'",
                                order_status='.$order_status.',
                                order_user="'.$order_user.'",
                                delivery_date="'.$delivery_date.'"
                                where product_id='.$product_id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        
        // https://techacademy.jp/magazine/11609
        if(empty($result)) {
            header('Location:login_tpl.php?user_id='.$user_id.'&password='.$password.'');
        } else {
            header('Location:products_change_page.php');
        }

    } catch (PDOException $e) {
    // 例外は発生したら無視
    //require_once 'products_add_information.php';

    echo $e->getMessage();
    }




    
?>