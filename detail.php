<?php
include("functions.php");
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
$id = $_GET["id"];

//1.  DB接続します
$pdo = db_con();
  
  //２．データ登録SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id =:id");
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);// ->のマークは「$stmtの中に」ということ
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
    error_db_info($stmt);
  }else{
        $row = $stmt->fetch();//１行だけとる
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー更新</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ユーザーID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
