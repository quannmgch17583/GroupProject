<?php 
    require_once("../db-conn.php");

    if(isset($_POST['update'])) {

            $id = $_POST['eid'];
            $username = $_POST['eusername'];
            $password = $_POST['epassword'];
            $name = $_POST['ename'];
            $department = $_POST['edepartment'];
            $role = $_POST['erole'];

            $password = md5($password);
            $query = "UPDATE account SET username='$username', password='$password', name='$name', role='$role', department='$department'
            WHERE  id='$id'";

            $res = mysqli_query($conn, $query);
            if($res){
                header("Location: ../admin-panel.php");
            }else{
                echo "Please check your query";
            }
            
        }else{
       header("Location: ../admin-panel.php");
    }
?>