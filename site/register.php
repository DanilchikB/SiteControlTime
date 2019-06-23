<?php
		session_start();
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 


		$link = mysqli_connect($host, $user, $password, $db_name);

	if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm'])){
	
		if ($_POST['password'] == $_POST['confirm']){
			$login = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$password = password_hash($password, PASSWORD_DEFAULT);
			$date = date('Y-m-d');
			$query = "SELECT * FROM users WHERE login='$login'";
			$user = mysqli_fetch_assoc(mysqli_query($link, $query));
		
			if (empty($user)) {
				$query = "INSERT INTO users SET login='$login', password='$password', registration_date='$date'";
				mysqli_query($link, $query);
		
				$_SESSION['auth'] = true;
		
				$id = mysqli_insert_id($link);
				$_SESSION['id'] = $id;
				header("Location: /index.php"); 
			}
		}	
	}
	
?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8">
<title>Регистрация</title>
 <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
<link href = "css/style.css?version=2" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
</head>
<body> 
	<div id = "allcontent">
		<div id="antifooter">
		<?php require_once "blocks/header.php"?>
			<div id="wrapper">
				<div id="leftcol">
				<?php if (!empty($_SESSION['auth'])) {
				echo "Вы вошли";
				}
				else{?>
					<div id = "regAut">
					<form action="" method="POST">
					<div class="title"><span>Регистрация</span></div>
					<input name="login" pattern="^[a-zA-Z0-9]+$" class="text" placeholder="Введите логин">
					<input name="password" type="password" class="text" placeholder="Введите пароль">
					<input name="confirm" type="password" class="text" placeholder="Повторите пароль">
					<input type="submit" value="Отправить" class="sending">
					</form>
					</div>
					<div class="reg"><p>Вы зарегистрированы?</p> <a href="login.php">Вход</a></div>
					<p id="problem">
					<?php
						if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm'])){
							if ($_POST['password'] == $_POST['confirm']){
								if (empty($user)) {}
								else echo "Пользователь c таким логином существует";
							}
							else{echo "Пароли не совпадают";}
			
						}
						else if(!empty($_POST)){echo "Заполните поля";
					unset($_POST);}
					?>
					</p>
				<?php }?>
				</div>
				<div id="rightcol">
					<div id="blockmenu">
					<ul>
						<li id="list"><a href="personalArea.php">Личный кабинет</a></li>
						<li id="list"><a href="pomidoro.html">Помидоро</a></li>
						<li id="list"><a href="notepad.php">Блокнот</a></li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	<footer>
		<div id="rights">
			Все права защищены &copy; <?=date ('Y')?>
		</div>
	</footer>
	<script src="menu.js"></script>
	</div>
</body> 
</html>
