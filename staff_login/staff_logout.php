<?php
    session_start();
    $_SESSION = array();
    if(isset($_COOKIE[session_name()]) == true){
        setcookie(session_name(),'',time()-42000,'/');
    }
    session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>たかくら八百屋オンライン</title>
</head>

<body>
    ログアウトしました<br>
    <br>
    <a href="../staff_login/staff_login.html"><input type="submit" value="ログイン画面へ"></a>
</body>

</html>
