<?php 
    if(isset($_SESSION['name'])){
    $sql = "SELECT * FROM chat WHERE department = 'Business'";
    $res = mysqli_query($conn, $sql);
    }else{
        header("Location: ../home.php");
    }
?>