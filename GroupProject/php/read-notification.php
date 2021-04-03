<?php 
	require_once('../db-conn.php');
    if(isset($_GET['GET'])) {
        $id = $_GET['GET'];

        $sql = "UPDATE notification SET status = '1' WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        
        if($res){
            header("Location: ../faculty-panel.php");
        }else{
            echo 'Query Error';
        }
	}else{
		echo 'Error';
	}
?>