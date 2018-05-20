<?php
    $pencil = $_POST['pencil'];
    $ruler = $_POST['ruler'];
    $eraser = $_POST['eraser'];
    $date = date('Y-m-d,h:i');
    // $document_root = $_SERVER['DOCUMENT_ROOT'];
    define ('PRIPEN' , 1);
    define ('PRIRUL' , 3);
    define ('PRIERA' , 2);
    if($pencil ==0 && $ruler == 0 && $eraser ==0){
        echo "你没有购买任何商品！";
    }
    else{
        if($pencil>0){
            echo "<p>你买了：".$pencil."支铅笔。</p>";
        }
        else {
            $pencil = 0;
            echo "<p>你没有买铅笔。</p>";
        }
        if($ruler>0){
            echo "<p>你买了：".$ruler."把尺子。</p>";
        }
        else{
            $ruler = 0;
            echo "<p>你没有买尺子。</p>";
        }
        if($eraser>0){
            echo "<p>你买了：".$eraser."个橡皮。</p>";
        }
        else{
            $eraser = 0;
            echo "<p>你没有买橡皮。</p>";
        }
        $sum = $pencil * PRIPEN + $ruler * PRIRUL + $eraser * PRIERA;
        echo "<strong>你一共花了".$sum."元钱！</strong>";
    }
    // echo "$document_root/../data/data.txt";
    $writestring = $date."\t".$pencil."\t".$ruler."\t".$eraser."\r\n";
    @$fp = fopen("data.txt",'a');
    if(!$fp){
        echo "<p>打开文件失败</p>";
        exit;
    }
    flock($fp,LOCK_EX);
    fwrite($fp,$writestring,strlen($writestring));
    flock($fp,LOCK_UN);
    fclose($fp);
    echo "<p>写入成功</p><br /><a href='view.php'>点击查看</a>";
?>