<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
    <h1>Book-O-Rama Book Entry Results</h1>
    <?php
        if(!isset($_POST['ISBN'])||!isset($_POST['Title'])||!isset($_POST['Author'])||!isset($_POST['Price'])){
            echo "<p>You have not entered all the require details.<br />
                Please go back and try again.</p>";
            exit;
        }
        $isbn = $_POST['ISBN'];
        $author = $_POST['Author'];
        $title = $_POST['Title'];
        $price = $_POST['Price'];
        $price = doubleval($price);

        @$db = new mysqli('localhost','user','123456','study');
        if(mysqli_connect_errno()){         //面向过程以mysqli_开始
            echo '<p>Error: Could not connect to database.<br />
            Please try again later.</p>';
            exit;
        }
        $query = "INSERT INTO Books VALUES (?,?,?,?)";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param('sssd',$isbn,$author,$title,$price);
        $stmt -> execute();
        if($stmt -> affected_rows > 0){
            echo "<p>Book insertd into the database.</p>";
        }
        else{
            echo "<p>An error has occured.<br />
            The item was not added.</p>";
        }
        $db -> close(); //关闭数据库连接
    ?>
</body>
</html>