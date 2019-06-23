<?php session_start();?>
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
					<p>
					Просто главная страница
					</p>
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