<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book-O-Rama Search Results</title>
</head>
<body>
    <h1>Book-O-Rama Search Results</h1>
    <?php
        $searchtype = $_POST['searchtype'];
        $searchterm = trim($_POST['searchterm']);   //trim移除两侧空格字符串
        if(!$searchterm || !$searchtype){
            echo '<p>You have not entered search details.<br />
                Please go back and try again.</p>';
            exit;
        }
        switch($searchtype){
            case 'Title':
            case 'Author':
            case 'ISBN':
                break;
            default:
                echo '<p>That is not a valid search type.<br />
                Please go back and try again.</p>';
                exit;
        }
        //----------------数据获取和处理结束，下面是数据库操作-----------------
        $db = new mysqli('localhost','user','123456','study');//可以在开头加入@，抑制错误
        //mysqli 表示版本优化，mysql进阶版`
        //$mysqli = new mysqli("localhost", "my_user", "my_password", "my_db_name");
        if(mysqli_connect_errno()){         //面向过程以mysqli_开始
            echo '<p>Error: Could not connect to database.<br />
            Please try again later.</p>';
            exit;
        }
        $query = "SELECT ISBN,Author,Title,Price
                  From books WHERE $searchtype = ?";
        $stmt = $db -> prepare($query); //构造后续查询所需对象或资源
        $stmt -> bind_param('s',$searchterm);   //解释问号填充的内容，s表示字符串
        $stmt -> execute(); //真正的数据库查询操作开始
        $stmt -> store_result();    //先读取并缓存查询返回的数据行
        $stmt -> bind_result($isbn, $author, $title, $price);   //接收查询结果
        echo "<p>Number of books found:".$stmt->num_rows."</p>";    //返回数据行数，从对象的num_rows成员读取
        while($stmt->fetch()){  //获取每一行数据
            echo "<p><strong>Title:".$title."</strong>";
            echo "<br />Author:".$author;
            echo "<br />ISBN:".$isbn;
            echo "<br />Price:\$".number_format($price,2)."</p>";
        }
        $stmt -> free_result(); //释放结果集
        $db -> close(); //关闭数据库连接
    ?>
</body>
</html>