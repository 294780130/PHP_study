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
        // @$fp = fopen("data.txt",'r');
        // flock($fp,LOCK_SH);
        // if(!$fp){
        //     echo   "<p>读文件失败</p>";
        //     exit;
        // }
        // while(!feof($fp)){
        //     $order = fgets($fp);
        //     echo htmlspecialchars($order)."<br />";
        // }
        // flock($fp,LOCK_UN);
        // fclose($fp);
        $orders = file("data.txt");
        $number = count($orders); 
        if($number == 0){
            echo "<p>没有查询到记录</p>";
        }
        else{
            echo "<table>
                <tr>
                    <th>时间</th>
                    <th>铅笔</th>
                    <th>尺子</th>
                    <th>橡皮</th>
                </tr>";
            for($i = 0 ; $i < $number ; $i++){
                $line = explode("\t",$orders[$i]);
                echo "<tr>";
                for($j = 0 ; $j < 4 ; $j++){
                    echo "<td>".$line[$j]."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</body>
</html>