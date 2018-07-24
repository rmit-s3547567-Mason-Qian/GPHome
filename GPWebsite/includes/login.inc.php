<?php

session_start();

if (isset($_POST['submit'])) {

	include 'dbh.inc.php';

	$id = mysqli_real_escape_string($conn, $_POST['id']);

	//error handling
	//check if input are empty
	if (empty($id)) {
		header("Location: ../index.php?search=empty");
		exit();
	} else {
		$sql = "SELECT * FROM blobData WHERE idData='$id'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//de hash password
				//$hashedPwordCheck = password_verify($pword, $row['user_pword']);
				//if ($hashedPwordCheck == false) {
				//	header("Location: ../index.php?login=error");
				//	exit();
				//} else if ($hashedPwordCheck == true) {
					//log in user here
					$_SESSION['id'] = $row['idData'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['type'] = $row['type'];
					$_SESSION['data'] = $row['data'];
					$_SESSION['time'] = $row['time'];
					$_SESSION['temp'] = $row['temp'];
					$_SESSION['heart'] = $row['heart'];
					header("Location: ../index.php?search=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?search=error");
	exit();
}