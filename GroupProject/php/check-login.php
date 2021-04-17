<?php
session_start();
include "../db-conn.php";

if (isset($_POST['username']) && isset($_POST['password'])){

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input(($_POST['username']));
    $password = test_input(($_POST['password']));

    if (empty($username)) {
        header("Location: ../index.php?error=Username is required");
    }else if (empty($password)) {
        header("Location: ../index.php?error=Password is required");
    }else{
        $password = md5($password);
        $sql = "SELECT * FROM account WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password && $row['role'] === 'admin') {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];
                header("Location: ../admin-panel.php");
            }
            if($row['password'] === $password && $row['role'] === 'student') {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header("Location: ../student-panel.php");
            }
            if($row['password'] === $password && $row['role'] === 'coordinator') {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header("Location: ../faculty-panel.php");
            }
            if($row['password'] === $password && $row['role'] === 'manager') {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header("Location: ../manager-panel.php");
            }
            if($row['password'] === $password && $row['role'] === 'guest') {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header("Location: ../guest-panel.php");
            }
        }else{
            header("Location: ../index.php?error=Incorrect Username or Password");
        }
    }

}else{
    header("Location: ../index.php");
}

