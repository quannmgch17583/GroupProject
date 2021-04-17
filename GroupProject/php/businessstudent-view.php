<?php
if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $sql = "SELECT * FROM submission WHERE department = 'Business'";
    $res = mysqli_query($conn, $sql);
}else{
    header("Location: ../index.php");
} ?>