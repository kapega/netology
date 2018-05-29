<?php
	session_start();
	if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{ 
		
			echo "Отлично , кажется, что вы не робот";
	}	else {  
		
			echo "вы весьма надоедливый бот!";
	}
?>