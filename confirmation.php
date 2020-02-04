<?php
session_start();  //セッションを使う
 
$message = "";
if (isset($_POST['send'])){
    //メール送信
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
 
    $email = "";     // 送信元メール(用意しているサーバのもの(好きなもので良い))
    $subject = "お問い合わせがありました"; // 題名
    $to = 'securio12@gmail.com';           // 送信先メール(個人のメール)
    $header = "From: ". mb_encode_mimeheader("お問い合わせ通知") . "<$email>";
    $body =
        "
        以下の内容によるお問い合わせがありました。\n
        [お名前]\n
        {$_SESSION['inquiry']['name']}\n
        [ご連絡先(メールアドレス)]\n
        {$_SESSION['inquiry']['mail']}\n
        [ご連絡先(電話番号)]\n
        {$_SESSION['inquiry']['tel']}\n
        [お問い合わせ内容]\n
        {$_SESSION['inquiry']['content']}\n
        ";
    $result = mb_send_mail($to, $subject, $body, $header);
 
    //送信結果
    if ($result){
        //セッション削除
        $_SESSION = [];
        session_destroy();
        //完了画面へ
        header('Location: complete.php');
        exit;
    }
    else {
        $message = "お問い合わせ送信に失敗しました。";
    }
}
 
?>
 
 
<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 確認画面</title>
</head>
 
<body>
<h1>お問い合わせ - 確認画面</h1>
<br>
<p style="color: red"><?php echo $message ?></p>
<form method="post" action="confirm.php">
    <p>
        [お名前]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['name']); ?>
    </p>
    <p>
        [ご連絡先(メールアドレス)]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['mail']); ?></p>
    <p>
        [ご連絡先(電話番号)]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['tel']); ?></p>
    <p>
        [お問い合わせ内容]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['content']); ?></p>
    <br>
    <input type="submit" name="send" value="送信">
</form>
<div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>
 
</body>
</html>
