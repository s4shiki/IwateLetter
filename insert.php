<?php

// DBへの接続
try {
	$db = new SQLite3('litter.db');
} catch (Exception $e) {
	echo 'DBへの接続でエラーが発生しました。';
	echo $e->getTraceAsString();
}

$letter = $_POST["body"];

// リクエストデータが存在しない場合は、エラーを返す
if (!$letter) {
	print "POSTデータがありません";
}

$db->exec("INSERT INTO letter (letter) VALUES ('". $letter ."')");


$last_id = $db->lastInsertRowID();
//print "". $last_id ."番目に追加されました";
$res[] = array('type' =>'status', 'id' => $last_id);
$result = json_encode($res);
echo $result;
/*
$result = $db->query("SELECT * FROM letter WHERE id = '".$last_id."'");
var_dump($result->fetchArray());
*/
// SQLiteに対する処理
$db->close();