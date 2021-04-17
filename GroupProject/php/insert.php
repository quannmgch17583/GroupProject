<?php 
    require_once("../db-conn.php");

    if(isset($_POST['insertdata'])) {
        if(empty($_POST['nusername']) || empty($_POST['npassword']) || empty($_POST['nname']) || empty($_POST['nrole'])){
            echo 'Please fill all the blank';
        }else{
            $username = $_POST['nusername'];
            $password = $_POST['npassword'];
            $name = $_POST['nname'];
            $department = $_POST['ndepartment'];
            $role = $_POST['nrole'];

            $password = md5($password);
            $query = "INSERT INTO account(username, password, name, role, department) 
            VALUES('$username', '$password', '$name', '$role', '$department')";

            $res = mysqli_query($conn, $query);
            if($res){
                header("Location: ../admin-panel.php");
            }else{
                echo "Please check your query";
            }
            
        }
    }else{
       header("Location: ../admin-panel.php");
    }
?>