<?php
        
         session_start();
        include_once('function.php');
        $db = connect_db();
        $msg = '';
        
         if(!is_auth()){
               header('Location: login.php');
                exit();
            }
        
        if(count($_POST) > 0){
        // POST
        $id = $_GET['param'];
        $title = clean($_POST['title']);
        $content = clean($_POST['content']);
        
     
        if($title != '' && $content != ''){

                $sql = "UPDATE news SET title=:title, content=:content WHERE id_news='$id'";
                $query = $db->prepare($sql);
                $params =['title' => $title, 'content' => $content];
                $query->execute($params);

                if($query->errorCode() != PDO::ERR_NONE){
                    $info =  $query->errorInfo();
                    echo implode('<br>', $info);
                    exit();
                }

                header("Location: index.php");
                exit();
            }
            else{
                    $msg =  '<div>Заполните пожалуйста поля!</div>';     
                   }
        
    } 
    else{
        // GET
         $id = $_GET['param'];
         


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
        }
        else {
            echo "<div>Такой новости не сущестует</div>";
            $title = '';
            $content = '';
        }
    }
?>
<!doctype html>
<html>
<head>
    <title>Редактирование новостей</title>
</head>
<body>
            <h2>Редактирование новостей</h2>
	<form method="post">
		Название новости:<br><br>
		<input type="text" name="title" value="<?=$title;?>"><br><br>
		Содержимое файла:<br><br>
		<textarea name="content"><?=$content ?></textarea><br><br>
		<input type="submit" value="Сохранить"><br><br>
	</form>
    <?=$msg?>
    <a href="index.php">Просмотр всех записей</a>
</body>
</html>	