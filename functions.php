<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_con(){
    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
        return $pdo;//function()で囲んだので値を返すようにする
      } catch (PDOException $e) {
        exit('データベースに接続できませんでした。'.$e->getMessage());
      }
    }

//SQL処理エラー
function error_db_info($stmt){//functionで囲んだので引数が必要になる。$stmtをそのまま入れる
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);//()内に何も記述しなければエラー時に何も表示させないことができる
    }

//XSS:htmlspecialchars
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);//一度変数に入れてもいいが省略的書き方
}



?>
