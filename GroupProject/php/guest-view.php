<?php
    if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
        $department = $_SESSION['department'];

        $sql = "SELECT * FROM submission WHERE status = 'Accepted' and department = '$department'";
        $res = mysqli_query($conn, $sql);
    }else{
        header("Location: ../index.php");
} ?>