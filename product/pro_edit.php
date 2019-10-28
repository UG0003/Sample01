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
    <?php
        try{
            $pro_code = $_GET['procode'];
            
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);
            
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou_name_old = $rec['gazou'];
            
            $dbh = null;
            
            if($pro_gazou_name_old == ''){
                $disp_gazou = '';
            }else{
                $disp_gazou = '<img src = "./gazou/'.$pro_gazou_name_old.'">';
            }
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    商品修正<br>
    <br>
    商品コード<br>
    <?php print $pro_code; ?><br>
    <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>">
        <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
        商品名<br>
        <input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br>
        価格<br>
        <input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br>
        画像を選んでください<br>
        <input type="file" name="gazou" style="width:400px"><br>
        <br>
        <a href="pro_list.php"><input type="button" onclick="hisotry.back()" value="戻る"></a>
        <input type="submit" value="OK">
    </form>
</body>

</html>
