<?php

	$connection = new mysqli("localhost", "root", "");

	$res = mysqli_query($connection,"SHOW DATABASES");
	$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
	$db_exist = False;
	foreach ($rows as $row) {
		if($row['Database'] == "476project")
			$db_exist = True;
	}
	if(!$db_exist){
		$create_db = "CREATE DATABASE 476project";
		if(!mysqli_query($connection, $create_db))
			echo "Create DB Query Error: " . mysqli_error($connection);

		$create_table = "CREATE TABLE products (
			company TEXT NOT NULL,
			address TEXT NOT NULL,
			product_type TEXT NOT NULL,
			product_category TEXT NOT NULL,
			product TEXT NOT NULL,
			cheating_reason TEXT NOT NULL,
			active_substance TEXT NOT NULL,
			latitude TEXT NOT NULL,
			longitude TEXT NOT NULL,
			brand TEXT NOT NULL,
			serial_number TEXT NOT NULL,
			document_date TEXT NOT NULL)";

		$connection = mysqli_connect("localhost", "root", "", "476project");
		if(!mysqli_query($connection, $create_table))
			echo "Create TABLE Query Error: " . mysqli_error($connection);
	}
	mysqli_close($connection);
	
?>