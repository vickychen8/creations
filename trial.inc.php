<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
    echo "</pre>";
} else {
	header("Location: index.php");
}