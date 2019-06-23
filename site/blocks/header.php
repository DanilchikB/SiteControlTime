<header>
		<div id="logo">
			<a href="/" title="Перейти на главную">TimeControl</a>
		</div>
		<div id="mainMenu" onclick="changeMainMenu()">
			<div><p>=<p></div>
		</div>
		
		
		<div id="regAuth">
		<?php if (!empty($_SESSION['auth'])){?>
			<a href="logout.php">Выйти</a>
		<?php }
		else {?>
			<a href="login.php">Войти</a>
		<?php }?>
		</div>
</header>