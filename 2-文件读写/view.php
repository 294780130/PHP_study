<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>查看记录</title>
</head>
<body>
    <h1>读取文件记录</h1>
    <?php
        // $document_root = $_SERVER['DOCUMENT_ROOT'];
        @$fp = fopen("data.txt",'r');
        flock($fp,LOCK_SH);
        if(!$fp){
            echo   "<p>读文件失败</p>";
            exit;
        }
        while(!feof($fp)){
            $order = fgets($fp);
            echo htmlspecialchars($order)."<br />";
        }
        flock($fp,LOCK_UN);
        fclose($fp);
    ?>
</body>
</html>