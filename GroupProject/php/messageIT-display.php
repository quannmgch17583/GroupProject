<?php 
    if(isset($_SESSION['name'])){
    $sql = "SELECT * FROM chat WHERE department = 'IT'";
    $res = mysqli_query($conn, $sql);
    }else{
        header("Location: ../home.php");
    }
?>