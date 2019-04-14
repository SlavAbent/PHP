<?php
	session_start();
   
    if(count($_POST) > 0){
        //пришли методом POST  
        
        if($_POST['login'] == 'admin' && $_POST['password'] == 'qwerty'){
            $_SESSION['auth'] = true;
            
            if(isset($_POST['remember'])){
                setcookie('login', 'admin', time() + 3600 * 24 * 7);
                setcookie('password', md5('qwerty'), time() + 3600 * 24 * 7);
            }
            header('Location: index.php');
            exit();
        }
    }
    else{
        //пришли методом GET
        unset($_SESSION['auth']);
        setcookie('login', 'admin', time() - 1);
        setcookie('password', 'qwerty', time() - 1);

    }
?> 
<form method="post">
	Логин<br>
	<input type="text" name="login"><br>
	Пароль<br>
	<input type="password" name="password"><br>
	<input type="checkbox" name="remember">Запомнить меня<br>
	<input type="submit" value="Войти"><br>
            <a href="index.php">На главную страницу</a>
</form>