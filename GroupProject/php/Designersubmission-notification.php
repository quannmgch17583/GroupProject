<?php 
	require_once('../db-conn.php');
    if(isset($_GET['GET'])) {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $department = 'Designer';
        $studentName = $_GET['GET'];
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO notification(studentName, cr_date, department) VALUES('".$studentName."', '$date', '$department')";
        $res = mysqli_query($conn, $sql);
        
        if($res){
            header("Location: ../student-panel.php");
        }else{
            echo 'Query Error';
        }
	}else{
		echo 'Error';
	}
?>