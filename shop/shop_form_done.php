<?php
    session_start();
    session_regenerate_id(true);
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
            require_once('../common/common.php');
            
            $post = sanitize($_POST);
            
            $onamae = $post['onamae'];
            $email = $post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $tel = $post['tel'];
            
            print $onamae.'様<br>';
            print 'ご注文ありがとうございました。<br>';
            print '商品は以下の住所に発送させていただきます。<br>';
            print $postal1.'-';
            print $postal2.'<br>';
            print $address.'<br>';
            print $tel.'<br><br>';
            
            
            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            $max = count($cart);
            
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            for($i=0;$i<$max;$i++){
                $sql = 'SELECT name,price FROM mst_product WHERE code=?';         
                $stmt = $dbh->prepare($sql);
                $data[0] = $cart[$i];
                $stmt ->execute($data);
                
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $name = $rec['name'];
                $price = $rec['price'];
                $kakaku[] = $price;
                $suryo = $kazu[$i];
            }
                
            $sql ='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = 0;
            $data[] = $onamae;
            $data[] = $email;
            $data[] = $postal1;
            $data[] = $postal2;
            $data[] = $address;
            $data[] = $tel;
            $stmt->execute($data);
            
            $sql = 'SELECT LAST_INSERT_ID()';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastcode = $rec['LAST_INSERT_ID()'];
            
            
            for($i=0;$i<$max;$i++){
                $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $data = array();
                $data[] = $lastcode;
                $data[] = $cart[$i];
                $data[] = $kakaku[$i];
                $data[] = $kazu[$i];
                $stmt->execute($data);
            }
                    
            $dbh = null;       
            print '<a href="clear_cart.php"><input type = "submit" value = "商品一覧"></a>';
        }catch(Exception $e){
            print '只今障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
</body>

</html>
