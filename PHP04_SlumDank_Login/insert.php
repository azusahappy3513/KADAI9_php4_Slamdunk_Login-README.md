<?php
//1. POSTデータ取得
$name = $_POST['name'];
$email = $_POST['email'];
$sensyu = $_POST['sensyu'];
$school = $_POST['school'];
$word = $_POST['word'];
$content = $_POST['content']; //追加されています

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO
                        az_slam_sensyu(id, name, email, sensyu, school, word, content, date)
                        VALUES(NULL, :name, :email, :sensyu, :school, :word, :content, sysdate() );');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':sensyu', $sensyu, PDO::PARAM_STR);
$stmt->bindValue(':school', $school, PDO::PARAM_STR);
$stmt->bindValue(':word', $word, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
