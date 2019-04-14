 <?php
    
    session_start(); // Проверка сессии
     include_once('function.php');
     
     if(!is_auth()){
               header('Location: login.php');
                exit();
            }

    $db = connect_db();   //Соединение с БД
    
    $msg = '';

    if(count($_POST) > 0){
        // POST
        $title = clean($_POST['title']);
        $content = clean($_POST['content']);

            if($title != '' && $content != ''){

                $sql = "INSERT INTO news (title, content) VALUES (:title, :content)";
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
        $title = '';
        $content = '';
        
    }

?>
<!doctype html>
<html>
<head>
    <title>Добавление новости</title>
</head>
<body>
            <h2>Добавление новости</h2>
	<form method="post">
		<div>Название новости:</div>
		<input type="text" name="title" value="<?=$title;?>"><br><br>
		<div>Содержимое новости:</div>
		<textarea name="content"><?=$content ?></textarea><br><br>
		<input type="submit" value="Сохранить"><br><br>
	</form>
    <?php echo $msg; ?>
            <a href="index.php">Просмотр всех записей</a>
</body>
</html>	