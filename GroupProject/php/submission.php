<?php
if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $sessionID = $_SESSION['id'];
    $sql = "SELECT * FROM submission WHERE studentID = '$sessionID'";
    $res = mysqli_query($conn, $sql);
}else{
    header("Location: ../student-panel.php");
} ?>