<?php 
    require_once("../db-conn.php");

    if(isset($_GET['Del'])){

        $cID = $_GET['Del'];
        $sql = "DELETE FROM contribution WHERE cID = '".$cID."'";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("Location: ../admin-panel.php");
        }else{
            echo 'Please check your query';
        }
    }
?>