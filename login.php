<?php
    $user_id = $_GET["user_id"];
    $password = $_GET["password"];

try {

    // データベースに接続
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
 
    // SQL文をセット
    $stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = :user_id AND password = :password');
 

    // バインド
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':password', $password);

    // SQL文を実行
    $stmt->execute();

    // 実行結果のフェッチ
    $result = $stmt->fetchAll();
    if(empty($result)) {
        require_once 'login.html';
    } else {
        $user_name = $result[0]["name"];
        header('Location:login_tpl.php?user_id='.$user_id.'&password='.$password.'');
    }




} catch (PDOException $e) {
    // 例外は発生したら無視
    //require_once 'exception_tpl.php';

    echo $e->getMessage();
    exit();
}


/*

// ループして1レコードずつ取得
 foreach ($stmt as $row) {
    echo ($row["user_id"]);
    echo ", ";
    echo ($row["name"]);
    echo ", ";
    echo ($row["password"]);
    echo ", ";
    echo ($row["permission"]);
    echo"<BR>";
    
}
    require_once 'login_tpl_success.php';
?>

*/








?>




