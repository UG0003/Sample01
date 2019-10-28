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
        require_once('../common/common.php');
        
        $post = sanitize($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou = $_FILES['gazou'];
        
        if($pro_name == ''){
            print '商品が入力されていません。<br>';
        }else{
            print '商品名：';
            print $pro_name.'<br>';
        }
        
        if(preg_match('/\A[0-9]+\z/',$pro_price) == 0){
            print '価格を正しく入力してください。<br>';
        }else{
            print '価格：';
            print $pro_price;
            print '円<br>';
        }
        
        if($pro_gazou['size'] > 0){
            if($pro_gazou['size'] > 100000){
                print '画像が大きすぎます';
            }else{
                move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
                print '<img src = "./gazou/'.$pro_gazou['name'].'">';
                print '<br>';
            }
        }
    
        if($pro_name == '' || preg_match('/\A[0-9]+\z/',$pro_price) == 0 ||$pro_gazou['size'] > 100000){
            print '<form>';
            print '<input type = "button" onclick = "history.back()" value = "戻る">';
            print '</form>';
        }else{
            print '上記の商品を追加します。';
            print '<form method = "post" action = "pro_add_done.php">';
            print '<input type = "hidden" name = "name" value = "'.$pro_name.'">';
            print '<input type = "hidden" name = "price" value = "'.$pro_price.'">';
            print '<input type = "hidden" name = "gazou_name" value = "'.$pro_gazou['name'].'">';
            print '<br>';
            print '<input type = "button" onclick = "history.back()" value = "戻る">';
            print '<input type = "submit" value = "OK">';
            print '</form>';
        }
    ?>

</body>

</html>
