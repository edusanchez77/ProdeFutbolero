<?php
	session_start();

	if($_SESSION['usuario']){
		session_destroy();
		header("location:index.html");
	}else{
		header("location:index.html");
	}
?>