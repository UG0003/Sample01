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
    カートに商品が入っていません<br>
    <a href="shop_list.php"><input type="button" onclick="hisotry.back()" value="商品一覧へ戻る"></a>
</body>

</html>
