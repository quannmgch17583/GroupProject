<?php 
    require_once("../db-conn.php");

    if(isset($_POST['settingsbtn'])) {

            $id = $_POST['nid'];
            $password = $_POST['npassword'];


            $password = md5($password);
            $sql = "UPDATE account SET password='$password' WHERE  id='$id'";
            $res = mysqli_query($conn, $sql);
            if($res){
                header("Location: ../logout.php");
            }else{
                echo 'Error';
            }

            
        }else{
       echo 'Querry Error';
    }
?>