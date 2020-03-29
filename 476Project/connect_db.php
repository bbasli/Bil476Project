<?php 

	$conn = mysqli_connect('localhost', 'root', '', '476project');

	if(!$conn)
		echo 'Connection error: ' . mysqli_connect_error();

?>