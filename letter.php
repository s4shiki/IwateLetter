<!DOCTYPE HTML>
<html id="html_doc" lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Iwate Letter</title>
    <!-- ここからjQueryの読み込み -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<!-- ここからjQueryUIの読み込み -->
    <link rel="stylesheet" src="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css">
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
	<!-- ここからjQueryMobileの読み込み -->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	
	
	<!-- cssファイルとjsファイルの読み込み -->
	<link rel="stylesheet" href="letter-l.css">
	<script type="text/javascript" src="WriteLetter.js"></script>
    </head>
    <body>
    
    <div id="#home" data-role="page">
    
    <div data-role="header">
        <h1>いわてレター</h1>
    </div>
    <div data-role="content">
 		<!-- 便箋 -->
 		<div id="letter_area">
<?php
// DBへの接続
try {
	$db = new SQLite3('litter.db');
} catch (Exception $e) {
	echo 'DBへの接続でエラーが発生しました。';
	echo $e->getTraceAsString();
}
  
// リクエストからデータを取得
$id = $_GET["id"];
//$id = $db->escapeString($id);
  
// リクエストデータが存在しない場合は、エラーを返す
if (!$id) {
	print "ページが存在しません";
}
	
// SQLの実行
$result = $db->query('SELECT letter FROM letter WHERE id = '. $id .'');
  
while ($row = $result->fetchArray()) {
	echo $row['letter'];
}

//echo $letter;
// DBとの接続をクローズ
$db->close();
?>
		</div>
</body>
</html>