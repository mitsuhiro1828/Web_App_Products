
<?php
    /*
    https://tenderfeel.xsrv.jp/php/639/
    https://www.sejuku.net/blog/70234
    */
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
    define('MAX','5'); // 1ページの記事の表示数

    // 表示させるレコードを取得
    $stmt = $pdo->prepare('SELECT product_id, type.name as type_name, products.name as products_name, price, order_date, status, order_user, delivery_date
                            FROM products
                            inner join status on products.order_status = status.status_id
                            inner join type on products.type = type.type_id');
    $stmt->execute();
    $products =$stmt->fetchAll();
    // var_dump($products);

    // 件数の総数を取得
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products');
    $stmt->execute();
    $result = $stmt->fetchAll();
    $cnt_sql = $result[0]["COUNT(*)"];
    //var_dump($result);
    //var_dump($cnt_sql);

    // 最大ページ数を取得
    $max_page = ceil($cnt_sql / MAX);
    //var_dump($max_page);
    //ページ数を取得
    if (!isset($_GET['page_id'])){
        $now = 1;
    } else {
        $now = $_GET['page_id'];
    }

    $start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

    // array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
    $disp_data = array_slice($products, $start_no, MAX, true);
    
    $products_cnt = 0;
    foreach($disp_data as $val){ // データ表示
        $products_cnt += 1;
        //echo $products_cnt. '　'.$val['type_name']. '　'.$val['products_name']. '　'.$val['price']. '　'.$val['order_date']. '　'.$val['status']. '　'.$val['order_user']. '　'.$val['delivery_date']. '<br />';
        echo $products_cnt. '　';
        echo $val['type_name']. '　'.$val['products_name']. '　'.$val['price']. '　'.$val['order_date']. '　'.$val['status']. '　'.$val['order_user']. '　'.$val['delivery_date']. '　';
        // echo '<a href= /products_change.php?user_id='.$user_id.'&password='.$password.'>'.$products_cnt. '　'.$val['type_name']. '　'.$val['products_name']. '　'.$val['price']. '　'.$val['order_date']. '　'.$val['status']. '　'.$val['order_user']. '　'.$val['delivery_date']. '<br />' .'</a> ';

        // 変更ボタンの設置
        echo '<input type="button" onclick="location.href=\'products_change_page.php?user_id='.$user_id.'&password='.$password.'&product_id='.$val['product_id'].'\'" value="変更">';

        // 削除ボタンの設置
        echo '<input type="button" onclick="location.href=\'products_delete.php?user_id='.$user_id.'&password='.$password.'&product_id='.$val['product_id'].'\'" value="削除" formaction=""><br/>';
    }
    
    
    if($now > 1){ // リンクをつけるかの判定
        echo '<a href=?page_id='.($now - 1).'&user_id='. $user_id.'&password='. $password.'>前へ</a>'. '　';
    } else {
        echo '前へ'. '　';
    }
    

    for($i = 1; $i <= $max_page; $i++) { // 最大ページ数分リンクを作成
        if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
            echo $now. '　'; 
        } else {
            echo '<a href=?page_id='. $i. '&user_id='. $user_id.'&password='. $password.'>'. $i. '</a>'. '　';
            //echo '<a href='?page_id='. $i. '')>'. $i. '</a>'. '　';
        }
    }

    
    if($now < $max_page){ // リンクをつけるかの判定
        echo '<a href=?page_id='.($now + 1).'&user_id='. $user_id.'&password='. $password.'>次へ</a>'. '　';
    } else {
        echo '次へ';
    }
    
    echo '<br>'; //改行
    echo '<input type=button onclick="location.href=\'products_add_information.php?user_id='.$user_id.'&password='.$password.'&product_id='.$val['product_id'].'\'" value="追加" formaction=""><br/>';
    

?>




