<?php 
    require_once("../db-conn.php");

    if(isset($_POST['updatecontribution'])) {

        $cID = $_POST['ucID'];
        $cName = $_POST['ucName'];
        $cDes = $_POST['ucDes'];
        $cStartDate = $_POST['ucStartDate'];
        $cEndDate = $_POST['ucEndDate'];
        $sql = "UPDATE contribution SET cName='$cName', cDes='$cDes', cStartDate='$cStartDate', cEndDate='$cEndDate' WHERE  cID='$cID'";

        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: ../admin-panel.php");
        }else{
            echo "Please check your query";
        }
            
        }else{
       header("Location: ../admin-panel.php");
    }
?>