<?php 
    require_once("../db-conn.php");

    if(isset($_GET['Del'])){

        $id = $_GET['Del'];
        $sql = "DELETE FROM account WHERE id = '".$id."'";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("Location: ../admin-panel.php");
        }else{
            echo 'Please check your query';
        }
    }
?>
