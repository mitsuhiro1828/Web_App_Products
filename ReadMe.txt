login.html ←ログイン画面(login.css適用)
	｜
	｜login.phpを実行
	↓
login_tpl.php ←プロダクトを５件づつ表示
	｜					｜					｜
	｜追加				｜変更				｜削除
	↓					↓					↓
products_add_information.php	products_change_page.php	products_delete.php
	｜					｜					｜
	｜products_add.phpを実行	｜products_change.phpを実行	｜products_delete_backside.phpを実行
	↓					↓					↓
	→				成功：login_tpl.phpに戻る		←

	｜					｜					｜
					　　エラー（失敗)
product_add\information.php	products_change_page.php		login_tpl.phpに戻る
に戻る				に戻る
