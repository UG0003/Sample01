<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login']) == false){
    print 'ログインされていません<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
    }else{
    print $_SESSION['staff_name'];
    print 'さんがログイン中<br>';
    print '<br>';
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>たかくら八百屋オンライン</title>
</head>

<body>
    スタッフ追加<br>
    <br>
    <form method="post" action="staff_add_check.php">
        スタッフ名を入力してください<br>
        <input type="text" name="name" style="width:200px"><br>
        パスワードを入力してください<br>
        <input type="password" name="pass" style="width:100px"><br>
        パスワードをもう一度入力してください<br>
        <input type="password" name="pass2" style="width:100px"><br>
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>

</html>
