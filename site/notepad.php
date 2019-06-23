<?php
		session_start();
		if (!empty($_SESSION['auth'])) {
		$id = $_SESSION['id'];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 


		$link = mysqli_connect($host, $user, $password, $db_name);
	
		$query = "SELECT * FROM notepad WHERE user_id='$id'";
		$result = (mysqli_query($link, $query));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
		}
?>
 
<!DOCTYPE html> 
<html> 
<head> 
	<?php
		$title="Блокнот";
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
					<div id="notepad">
					<h1>Блокнот</h1>
					<a href="createPost.php"id="createPost">Добавить пост<a><br>
					<?php
							$a = 1;
							for ($i=count($data)-1;$i>=0;$i--) 
							{
							echo '<form id ="record" action="/store.php" method="POST"><br>
							<div id = "alignment">
							<span>'.$a.'.</span>
							<input class="text" type="text" name="text" value="'.$data[$i]['text'].'" readonly>
							</div>
							<input type="hidden" name="text_id" value="'.$data[$i]['id'].'">
							<input class = "transform1" type="submit" name="transform1" value="Редактировать">
							<input class = "delete" type="submit" name="delete" value="Удалить">
							</form>';
							$a++;
							}
					?> 
					</div>
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


