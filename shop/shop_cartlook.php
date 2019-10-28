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
            if(isset($_SESSION['cart']) == true){
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);
            }else{
                $max = 0;
            }
            
            if($max == 0){
                print 'カートに商品が入っていません<br>';
                print '<br>';
                print '<a href="shop_list.php"><input type="button" onclick="hisotry.back()" value="戻る"></a>';
                exit();
            }
            
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            foreach($cart as $key => $val){
                $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code =?';
                $stmt = $dbh->prepare($sql);
                $data[0] = $val;
                $stmt->execute($data);
                
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $pro_name[] = $rec['name'];
                $pro_price[] = $rec['price'];
                if($rec['gazou'] == ''){
                    $pro_gazou[] = '';
                }else{
                    $pro_gazou[] = '<img src = "../product/gazou/'.$rec['gazou'].'">';
                }
            }
            $dbh = null;
            
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    カートの中身<br>
    <form method="post" action="kazu_change.php">
        <table border="1">
            <tr>
                <td>商品</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
            </tr>
            <?php for($i = 0; $i < $max; $i++){ ?>
            <tr>
                <td><?php print $pro_name[$i]; ?></td>
                <td><?php print $pro_gazou[$i]; ?></td>
                <td><?php print $pro_price[$i].'円'; ?></td>
                <td><input type="text" name="kazu<?php print $i;?>" value="<?php print $kazu[$i]; ?>"></td>
                <td><?php print $pro_price[$i] * $kazu[$i]; ?>円</td>
                <td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <input type="hidden" name="max" value="<?php print $max; ?>">
        <input type="submit" value="数量変更or削除">
    </form>
    <?php print '<a href = "clear_cart.php"><input type = "submit" value = "カートを空にする"></a><br>'; ?>
    <br>
    <a href="shop_list.php"><input type="button" onclick="hisotry.back()" value="商品一覧"></a>
    <br>
    <br>
    <a href="shop_form.html"><input type="submit" value="購入手続きへ進む"></a><br>
</body>

</html>
