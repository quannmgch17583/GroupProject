<?php 
    include_once('../db-conn.php');
    if(isset($_POST['addstatus'])){

        $sID = $_POST['statusid'];
        $status = $_POST['status'];

        $sql = "UPDATE submission SET status = '$status' WHERE sID = '$sID'";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("Location: ../faculty-panel.php");
        }else{
            echo 'Please check your query';
        }
    }else{
        echo 'Please check your query';
    }

?>