<?php session_start();?>
<!DOCTYPE html> 
<html> 
<head> 
	<?php
		$title="Добавить пост";
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
					<div id="createPost">
						<form action="/store.php" method="POST">
						<label for="">Запись</label><br>
						<textarea type="text" name="text" class="form"></textarea>
						<input type="submit" name="create" value="Добавить">
						<input type="submit" name="undo" onclick ="location.href='/notepad.php'" value="Отмена">
						</form>
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