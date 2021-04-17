<?php

include "../db-conn.php";
session_start();
    if(isset($_POST['sendmsg'])) {
        $name = $_SESSION['name'];
        $msg = $_POST['msg'];
        $department = 'IT';
        
        $sql="INSERT INTO chat(name, msg, department) VALUES ('$name', '$msg', '$department')";

        $res = mysqli_query($conn, $sql);

        if($res){
            header("Location: ../faculty-panel.php");
        }else{
            echo 'Query error';
        }
	}else{
        header("Location: ../index.php");
    }
?>