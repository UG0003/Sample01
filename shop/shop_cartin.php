<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login']) == false){
        print 'ようこそゲスト様　';
        //print '<a href = "member_login.html">会員ログイン画面</a><br>';
        print '<br><br>';
    }else{
        print 'ようこそ';
        print $_SESSION['member_name'];
        print '様';
        print '<a href ="member_logout.php">ログアウト</a><br>';
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
    <?php
        try{
            $pro_code = $_GET['procode'];
            
            if(isset($_SESSION['cart']) == true){
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                if(in_array($pro_code,$cart) == true){
                print 'その商品はすでにカートに入っています<br><br>';
                print '<a href = "shop_list.php"><input type ="submit" value = "商品一覧"></a>';
                exit();
                }
            }
            $cart[] = $pro_code;
            $kazu[] = 1;
            $_SESSION['cart'] = $cart;
            $_SESSION['kazu'] = $kazu;
            
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    カートに追加しました<br>
    <br>
    <a href="shop_list.php"><input type="submit" value="商品一覧"></a>
</body>

</html>
