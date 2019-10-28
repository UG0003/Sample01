<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login']) == false){
        print 'ログインされていません<br>';
        print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';
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
    ショップ管理トップメニュー<br>
    <br>
    <a href="../staff/staff_list.php"><input type="submit" value="スタッフ管理"></a><br>
    <br>
    <a href="../product/pro_list.php"><input type="submit" value="商品管理"></a><br>
    <br>
    <a href="staff_logout.php"><input type="submit" value="ログアウト"></a>
</body>

</html>
