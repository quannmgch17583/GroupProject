<?php 
    require_once("../db-conn.php");

    if(isset($_POST['insertcontribution'])) {

            $cName = $_POST['ncName'];
            $cDes = $_POST['ncDes'];
            $cStartDate = $_POST['ncStartDate'];
            $cEndDate = $_POST['ncEndDate'];

            $sql = "INSERT INTO contribution(cName, cDes, cStartDate, cEndDate) 
            VALUES('$cName', '$cDes', '$cStartDate', '$cEndDate')";

            $res = mysqli_query($conn, $sql);
            if($res){
                header("Location: ../admin-panel.php");
            }else{
                echo "Please check your query";
            }
            
    }else{
       header("Location: ../admin-panel.php");
    }
?>