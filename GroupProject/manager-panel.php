<?php 
    session_start();
    include "db-conn.php";
    if(isset($_SESSION['username']) && isset($_SESSION['id'])) { 
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];    
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/svg-with-js.css">
    <link rel="stylesheet" href="css/mystyle.css">

    <title>Manager Panel</title> 
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="header-content">
                <div class="side-head">

                </div>
                <div class="header-nav">
                    <ul>
                        <li><a href="#"><i class="fas fa-users"></i>&nbsp;Hello, <?=$_SESSION['name']?></a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
        <div class="wrapper">
            <input type="checkbox" id="check">
            <label for="check">
                <i class="fas fa-bars" id="btn"></i>
                <i class="fas fa-times" id="cancel"></i>
            </label>
            <section class="sidebar">
            <header id="headersidebar"></header>
                <ul class="nav-bar">
                    <li><a href="manager-panel.php"><i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
                    <li><a href="#"><i class="far fa-file"></i>&nbsp; View Submissions</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#settings" href="#"><i class="fas fa-user-cog"></i>&nbsp; Change Password</a></li>
                </ul>
            </section>
            <section class="working-panel">

                 <!-- Modal Change Password -->
                <div class="modal fade" id="settings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="php/settings.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Your ID: <?=$id?></span>
                                            <input type="hidden" name="nid" value="<?=$id?>" class="form-control"/>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Your Username: <?=$_SESSION['username']?></span>
                                            <input type="hidden" class="form-control"/>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Your Password: <?=$password?></span>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">New Password</span>
                                            <input type="text" name="npassword" class="form-control" required/>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                                            <label class="form-check-label" for="flexCheckDefault">Terms and Conditions</label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="settingsbtn" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Change Password -->
                <div class="container-fluid">
                <?php 
                    $sql = "SELECT * FROM submission WHERE department = 'IT' ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>

                    <div class="row" style="margin-left: 20%;">
                        <div class="col-md-3">
                            <div class="card bg-danger text-white text-center">
                                <div class="card-body">
                                    <h4 class="font-weight-light"><i class="far fa-file"></i>&nbsp;IT Contributions</h4>
                                    <hr>
                                    <h5>
                                        <b><?=$count?></b>
                                    </h5>
                                </div>
                            </div>
                        </div>

                <?php 
                    $sql = "SELECT * FROM submission WHERE department ='Business'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                        <div class="col-md-3">
                            <div class="card bg-success text-white text-center">
                                <div class="card-body">
                                    <h4 class="font-weight-light"><i class="far fa-file"></i>&nbsp;Business Contributions</h4>
                                    <hr>
                                    <h5>
                                        <b><?=$count?></b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                <?php 
                    $sql = "SELECT * FROM submission WHERE department = 'Designer'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white text-center">
                                <div class="card-body">
                                    <h4 class="font-weight-light"><i class="far fa-file"></i>&nbsp;Designer Contributions</h4>
                                    <hr>
                                    <h5>
                                        <b><?=$count?></b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="p-3" style="margin-top: 100px;">
                                <?php include 'php/manager-view.php'; 
                                    if (mysqli_num_rows($res) > 0 ) { ?>
                                <h1 class="display-4 fs-1 text-center">All Accepted Student Submissions</h1>
                                <table class="table table-dark" style="margin: auto; width: 100%;">
                                    <thead>
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Submission Name</th>
                                        <th scope="col">Contribution ID</th>
                                        <th scope="col">Submission File</th>
                                        <th scope="col">Student ID</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Comment by Faculty</th>
                                        <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $i=1;
                                        while ($rows = mysqli_fetch_assoc($res)) { 
                                            
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td data-label="ID" scope="row"><?=$rows['sID']?></td>
                                            <td data-label="Submission Name" class="table-active"><?=$rows['sName']?></td>
                                            <td data-label="Contribution ID"><?=$rows['cID']?></td>
                                            <td data-label="Submission File"><?=$rows['sUpload']?></td>
                                            <td data-label="Student ID"><?=$rows['studentID']?></td>
                                            <td data-label="Department" class="table-active"><?=$rows['department']?></td>
                                            <td data-label="Comment"><?=$rows['Comment']?></td>
                                            <td data-label="Status" class="table-active"><?=$rows['status']?></td>
                                        </tr>
                                    </tbody>
                                    <?php $i++;} ?>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                </div>
            </section>
        </div>
    


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>
<?php }else{
    header("Location: index.php");
} ?>

