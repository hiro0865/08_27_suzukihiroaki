<?php
//1.  DB接続します
include("functions.php");

$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  error_db_info($stmt);
  
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>';
    $view .= '<a href="bm_detail.php?id='.$result["id"].'">';
    $view .= $result["bookname"];
    $view .= '</td>';
    $view .= '<td>';
    $view .=$result["bookurl"];
    $view .= '</td>';
    $view .= '<td>';
    $view .=$result["comment"];
    $view .= '</td>';
    $view .='</a>';
    $view .= '</td>';
    $view .= '<td>';
    $view .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .='</a>';
    $view .= '</td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍データベース</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
table{width:100%; margin:5px;}
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_index.php">データ登録</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<div class="container jumbotron">
  <table>
    <tr>
    <th>書籍名(更新)</th>
    <th>書籍URL</th>
    <th>コメント</th>
    <th>削除</th>
    </tr>
    <?=$view?>
  </table>
</div>

<!-- Main[End] -->

</body>
</html>
