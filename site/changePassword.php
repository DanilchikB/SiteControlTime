<?php
		session_start();
		if (!empty($_SESSION['auth'])) {
		$id = $_SESSION['id'];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 

		
		$link = mysqli_connect($host, $user, $password, $db_name);
			
		$query = "SELECT * FROM users WHERE id='$id'"; 
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		
		$hash = $user['password']; 
	
		if (password_verify(htmlspecialchars($_POST['old_password']), $hash)) {
		
		if (!empty(htmlspecialchars($_POST['new_password'])) and !empty(htmlspecialchars($_POST['new_confirm'])) 
			and htmlspecialchars($_POST['new_password']) == htmlspecialchars($_POST['new_confirm'])){
			$newPasswordHash = password_hash(htmlspecialchars($_POST['new_password']), PASSWORD_DEFAULT);
			$query = "UPDATE users SET password='$newPasswordHash' WHERE id='$id'";
			mysqli_query($link, $query);
		}
		else {
			
			}
		} else {
		
		}
	}
?>
		<!DOCTYPE html> 
<html> 
<head> 
	<?php
		$title="Изменение пароля";
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
					<div id="changePassword">
					<form action="" method="POST">
					<p>Введите старный пароль</p>
					<input name="old_password" type="password"><br>
						<p>Введите новый пароль</p>
					<input name="new_password" type="password"><br>
						<p>Повторите новый пароль</p>
					<input name="new_confirm" type="password">
					<input type="submit" value="Отправить">
					</form>
					</div>
					<p id="problem">
					<?php
					if (password_verify(htmlspecialchars($_POST['old_password']), $hash)){
						if(htmlspecialchars($_POST['new_password']) == htmlspecialchars($_POST['new_confirm'])){}
						else echo"Пароли не совпадают";
					}
					else echo"Старый пароль не верен";
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
<?php
?>