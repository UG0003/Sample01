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
            $staff_code = $_GET['staffcode'];
            
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sql = 'SELECT name FROM mst_staff WHERE code=?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $staff_code;
            $stmt->execute($data);
            
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];
            
            $dbh = null;
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    スタッフ情報参照<br>
    <br>
    スタッフコード:<br>
    <?php print $staff_code;?><br>
    <br>
    スタッフ名:<br>
    <?php print $staff_name;?><br>
    <br>
    <form>
        <a href="staff_list.php"><input type="button" onclick="hisotry.back()" value="戻る"></a>
    </form>
</body>

</html>
