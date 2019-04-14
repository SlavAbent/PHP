<?php
        
        session_start();
        include_once('function.php');
        $db = connect_db();
        
        echo "<h2>Список Новостей </h2>";
        
        $sql = "SELECT *  FROM news ORDER BY dt_news DESC";
        $query = $db->prepare($sql);
        $query->execute();

                if($query->errorCode() != PDO::ERR_NONE){
                    $info =  $query->errorInfo();
                    echo implode('<br>', $info);
                    exit();
                }

               $news = $query->fetchAll();

               
               foreach($news as $one){
                    $title = $one['title'];
                    $id = $one['id_news'];
                    $dt = $one['dt_news'];  
                    $content =$one['content'];     
                    echo "<h3><a href=\"article.php?param=$id\">$title</a></h4>";
                    echo "<div>Опубликовано: $dt</div>";
                    echo "<div>$content</div>";
                      echo "<br>";
                     if (is_auth()){
                                echo "<br><div><a href=\"edit.php?param=$id\">Редактировать новость</a></div>";
                                echo "<div><a href=\"delete.php?param=$id\">Удалить новость</a></div>";
                         } 
                         echo '<hr>'; 
               }
              

?>   
           

<?php   
            if(is_auth()){
                    echo "<br><a href=\"add.php\">Добавить новость</a>";
                    echo "<br><a href=\"login.php\">Завершить сессию</a>";
            }
	else{
                    echo "<br><a href=\"login.php\">Вход в админ панель!</a>";
            }
?>