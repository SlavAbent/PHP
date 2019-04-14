<?php 
	
	//Функция для проверки прав авторизации
	function is_auth(){	
     if(!isset($_SESSION['auth'])){
            if($_COOKIE['login'] == 'admin' && $_COOKIE['password'] == md5('qwerty')){
            $_SESSION['auth'] = true;
        }  
        else{
        	return false;
        }
    }	
    		return true;	
}
	
	//функция для очистки полей от пробелов, спец.символов и php/html тегов
	  function clean($var = "") {  
            $var = trim($var);
            $var = htmlspecialchars($var);
            return $var;
            }

      //Функция соединения с БД     
	function connect_db(){
		$db = new PDO('mysql:host=localhost;dbname=php1', 'root', '');
    		$db->exec("SET NAMES UTF8");
    		return $db;
	}
 ?>