<?php
		session_start();
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 


		$link = mysqli_connect($host, $user, $password, $db_name);

		if (!empty($_POST['password']) and !empty($_POST['login'])) {
		
		
		$login = htmlspecialchars($_POST['login']);
		

		$query = "SELECT * FROM users WHERE login='$login'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		
		if (!empty($user)) {
			$hash = $user['password'];
			
			if(password_verify(htmlspecialchars($_POST['password']), $hash)){
				
			$_SESSION['auth'] = true;
			$_SESSION['id'] = $user['id'];
			
			header("Location: /index.php"); 
			}
			else{
				
			}
		} 
		else {
	
		}
		
	}
	
?>
<?php
	if (!empty($_SESSION['auth'])) {
	}
?>
<!DOCTYPE html> 
<html> 
<head> 
	<?php
		$title="Вход";
		require_once "blocks/head.php";
	?>
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
					<div class="title"><span>Вход</span></div>
					<input name="login" class="text" placeholder="Логин"><br>
					<input name="password" type="password" class="text" placeholder="Пароль"><br>
					<input type="submit" value="Отправить" class="sending"><br>
					</form>
					</div>
					<div class="reg">Еще не зарегистрированы? <a href="register.php">Регистрация</a></div>
					<p id="problem">
					<?php
					if (!empty($_POST['password']) and !empty($_POST['login'])) {
						if (!empty($user) and password_verify(htmlspecialchars($_POST['password']), $hash)){}
						else echo "Логин или пароль не совпадают";
					}
					else if(!empty($_POST)){echo "Заполните поля";
					unset($_POST);}
						
					?>
					</p>
				<?php }?>
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