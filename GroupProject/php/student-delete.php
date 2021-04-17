<?php 
    require_once("../db-conn.php");

    if(isset($_GET['Del'])){

        $sID = $_GET['Del'];
        $sql = "DELETE FROM submission WHERE sID = '".$sID."'";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("Location: ../student-panel.php");
        }else{
            echo 'Please check your query';
        }
    }
?>