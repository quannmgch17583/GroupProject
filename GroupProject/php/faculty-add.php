<?php 
    include_once('../db-conn.php');
    if(isset($_POST['addcomment'])){

        $sID = $_POST['commentid'];
        $Comment = $_POST['comment'];

        $sql = "UPDATE submission SET Comment = '$Comment' WHERE sID = '$sID'";
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