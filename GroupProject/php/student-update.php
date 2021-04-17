<?php 
	require_once('../db-conn.php');
	if (isset($_POST['supdate'])) {
		$sID = $_POST['susID'];
		$studentID = $_POST['sustudentID'];
		$sName = $_POST['suName'];
		$cID = $_POST['sucID'];


		$img_name = $_FILES['susubmission']['name'];
		$img_size = $_FILES['susubmission']['size'];
		$tmp_name = $_FILES['susubmission']['tmp_name'];
		$error = $_FILES['susubmission']['error'];

		if ($error === 0){
			if($img_size > 500000){
				$em = "Sorry, your file is too large";
				header("Location: ../student-panel.php?error=$em");
			}else{
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);

				$allowed_exs = array("jpg", "jpeg", "png", "docx", "doc", "pdf");

				if(in_array($img_ex_lc, $allowed_exs)){
					$sql = "UPDATE submission SET sName='$sName', cID='$cID', sUpload='$img_name' studentID='$studentID' WHERE sID='$sID'";
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