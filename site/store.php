<?php
		session_start();
		$id = $_SESSION['id'];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'test'; 


		$link = mysqli_connect($host, $user, $password, $db_name);
		
		//добавление
		if (!empty($_POST['create'])){
			$id = $_SESSION['id'];
			$text=htmlspecialchars($_POST['text']);
			$query = "INSERT INTO notepad SET text='$text',user_id='$id'";
			mysqli_query($link, $query);
			header("Location: /notepad.php");
		}
		
		//удаление
		else if (!empty($_POST['delete'])){
			$id = $_SESSION['id'];
			$text_id = $_POST['text_id'];
			$query = "DELETE FROM notepad WHERE id = '$text_id'";
			mysqli_query($link, $query);
			header("Location: /notepad.php");
		}
		
		//редактирование
		else if (!empty($_POST['transform1'])){
			$_SESSION['text']=htmlspecialchars($_POST['text']);
			$_SESSION['text_id']=$_POST['text_id'];
			header("Location: /transform.php");
		}
		else if (!empty($_POST['transform2'])){
			$text_id=$_SESSION['text_id'];
			$text=htmlspecialchars($_POST['text']);
			$query = "UPDATE notepad SET text='$text' WHERE id='$text_id'";
			mysqli_query($link, $query);
			header("Location: /notepad.php");
		}
		
		else header("Location: /notepad.php");
		
		
?>