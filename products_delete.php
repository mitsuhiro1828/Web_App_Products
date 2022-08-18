<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<?php
    $user_id = $_GET["user_id"];
    $password = $_GET["password"];
    $product_id = $_GET["product_id"];
?>
<body>
    <h2>削除してよろしいですか？</h2>
    <?php
        // 'はい'ボタンの設置
        echo '<input type="button" onclick="location.href=\'products_delete_backside.php?user_id='.$user_id.'&password='.$password.'&product_id='.$product_id.'\'" value="はい">';

        // 'いいえ'ボタンの設置
        echo '<input type="button" onclick="location.href=\'login_tpl.php?user_id='.$user_id.'&password='.$password.'\'" value="いいえ"><br/>';
    ?>

</body>
</html>





