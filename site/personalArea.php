<?php
		session_start();
		if (!empty($_SESSION['auth'])) {
		$id = $_SESSION['id'];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 


		$link = mysqli_connect($host, $user, $password, $db_name);
		
		if(!empty($_POST['new_login'])){
		$newLogin = htmlspecialchars($_POST['new_login']);	
		$query = "SELECT * FROM users WHERE login='$newLogin'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $query));
			if(empty($user)){
			$query = "UPDATE users SET login='$newLogin' WHERE id='$id'";
			mysqli_query($link, $query);
			}
		}
		}
?>
<!DOCTYPE html> 
<html> 
<head> 
	<?php
		$title="Главная страница";
		require_once "blocks/head.php";
	?>
	
</head>
<body> 
	<div id = "allcontent">
		<div id="antifooter">
			<?php require_once "blocks/header.php"?>
			<div id="wrapper">
				<div id="leftcol">
				<?php	if (!empty($_SESSION['auth'])) {?>
					<form action="" method="POST">
					<p>Введите новый логин</p>
						<input name="new_login" pattern="^[a-zA-Z0-9]+$">
						<input type="submit" value="Отправить">
					</form>
					<a href="changePassword.php">Сменить пароль</a>
					<p id="problem">
					<?php
					if(!empty($_POST['new_login'])){
					if(empty($user)){echo"успешно";}
					else echo"Такой логин существет";}
					?>
					</p>
					<?php	}
					else echo 'Войдите'?>
				</div>
				<div id="rightcol">
				<?php require_once "blocks/menu.php"?>	
				</div>
			</div>
		</div>
	<?php require_once "blocks/footer.php"?>
	</div>
</body> 
</html>