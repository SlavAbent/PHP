<!doctype html>
<html>
<head>
    <title>Новость</title>
</head>
<body>
    <?php
        include_once('function.php');
        $db = connect_db();
        $id = (int)$_GET['param'];

        
            if ($id != '' && ctype_digit($id)){
                
                $sql = "SELECT *  FROM news WHERE  id_news='$id'";
                $query = $db->prepare($sql);
                $query->execute();

                if($query->errorCode() != PDO::ERR_NONE){
                    $info =  $query->errorInfo();
                    echo implode('<br>', $info);
                    exit();
                }
                $news = $query->fetch();
                 
                 $title = $news['title']; 
                 $content = $news['content'];     
                 echo "<h2>$title</h2>";
                 echo "<div>$content</div>";

            }
          else{
                echo "<div>Такая  новость не существует!</div>";
            }
       
        
    ?>
    <a href="index.php">Назад</a>
    <br>
</body>
</html>	