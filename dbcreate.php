<?php

	try {
		$db = new SQLite3('litter.db');
		echo "接続されました。";
	} catch (Exception $e) {
		echo 'DBへの接続でエラーが発生しました。';
		echo $e->getTraceAsString();
	}

	$db->exec('CREATE TABLE letter (id INTEGER PRIMARY KEY,letter TEXT)');
	$db->exec("INSERT INTO letter (letter) VALUES ('This is a test2')");
	$result = $db->query('SELECT * FROM letter WHERE id = 7');
	var_dump($result->fetchArray());

	// SQLiteに対する処理
	$db->close();

	print('切断しました。<br>');
?>