<?php 
	require_once('../db-conn.php');
	if (isset($_POST['supload'])) {

		$studentID = $_POST['studentID'];
		$sName = $_POST['sName'];
		$cID = $_POST['cID'];
		$department = $_POST['department'];
		$date = date('Y-m-d H:i:s');

		$img_name = $_FILES['sSubmission']['name'];
		$img_size = $_FILES['sSubmission']['size'];
		$tmp_name = $_FILES['sSubmission']['tmp_name'];
		$error = $_FILES['sSubmission']['error'];

		if ($error === 0){
			if($img_size > 10000000){
				$em = "Sorry, your file is too large";
				header("Location: ../student-panel.php?error=$em");
			}else{
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);

				$allowed_exs = array("jpg", "jpeg", "png", "docx", "doc", "pdf");

				if(in_array($img_ex_lc, $allowed_exs)){
					$sql = "INSERT INTO submission(sName, cID, sUpload, studentID, department) VALUES ('$sName', '$cID', '$img_name', '$studentID', '$department')";
					$res = mysqli_query($conn, $sql);
					if($res === true){
						move_uploaded_file($tmp_name, "uploads/$img_name");
						header("Location: ../student-panel.php");
					}else{
						header("Location: ../student-panel.php");
					}
				}else{
					$em = "Type of this file is not allowed";
					header("Location: ../student-panel.php?error=$em");
				}
			}
		}else{
			$em = "Unknown error occurred!";
			header("Location: ../student-panel.php?error=$em");
		}
	}else{
		header("Location: ../student-panel.php");
	}
?>