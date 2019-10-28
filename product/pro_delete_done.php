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
            $pro_code = $_POST['code'];
            $pro_gazou_name = $_POST['gazou_name'];
                
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sql = 'DELETE FROM mst_product WHERE code=?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);
            
            $dbh = null
                
            if($pro_gazou_name != ''){
            unlink('./gazou/'.$pro_gazou_name);
            }
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    削除しました<br>
    <br>
    <a href="pro_list.php"><input type="button" value="戻る"></a>
</body>

</html>
