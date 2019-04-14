<?php 
	 session_start();
	 include_once('function.php');
	 $db = connect_db();
       
          if(!is_auth()){
             header('Location: login.php');
             exit();
            }

    $id = $_GET['param'];
    //Проверка файла на существование и на то что передан правильный параметр
    
    if ($id != '' &&  ctype_digit($id)){
			$sql = "DELETE FROM news WHERE id_news='$id'";
			$query = $db->prepare($sql);
			$query->execute();

                if($query->errorCode() != PDO::ERR_NONE){
                    $info =  $query->errorInfo();
                    echo implode('<br>', $info);
                    exit();
                }
                header("location: index.php");
                exit();
            }
          else{
                echo "<div>Файл не существует или битый!! </div>";
            }
?>
