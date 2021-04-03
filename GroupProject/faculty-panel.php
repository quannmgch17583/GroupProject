<?php 
    session_start();
    include "db-conn.php";
    if(isset($_SESSION['username']) && isset($_SESSION['id'])) { 
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $department = $_SESSION['department'];    
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

    <title>Coordinator Panel</title> 
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="header-content">
                <div class="side-head">

                </div>
                <?php 
                    $sql = "SELECT * FROM notification WHERE status = 0 AND department = '$department'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                <div class="header-nav">
                    <ul>
                        <li><a href="#"><i class="fas fa-users"></i>&nbsp;Hello, <?=$_SESSION['name']?></a></li>
                        <li><a href="#"><i class="far fa-bell"></i><span class="badge bg-danger" id="count"><?php echo $count; ?></span></a>
                                <div class="sub-menu-1">
                                    <?php 
                                        $sql = "SELECT * FROM notification WHERE status = 0 and department = '$department'";
                                        $res = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($res) > 0) { ?>
                                    <ul>
                                        <?php 
                                        while($rows = mysqli_fetch_assoc($res)) { ?>
                                        <li><a href="php/read-notification.php?GET=<?=$rows['id']?>"><?=$rows['studentName']?> <?=$rows['message']?> at <?=$rows['cr_date']?></a></li>
                                        <?php } ?>
                                    </ul>  
                                    <?php } ?>      
                                </div>
                        </li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="wrapper">
            <input type="checkbox" id="check">
            <label for="check">
                <i class="fas fa-bars" id="btn"></i>
                <i class="fas fa-times" id="cancel"></i>
            </label>
            <section class="sidebar">
            <header id="headersidebar"></header>
                <ul class="nav-bar">
                    <li><a href="faculty-panel.php"><i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
                    <li><a href="#"><i class="far fa-file"></i>&nbsp; Submissions</a></li>
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
                                            <span class="input-group-text" id="inputGroup-sizing-default">Your Faculty: <?=$department?></span>
                                            <input type="hidden" class="form-control"/>
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

                <?php if($_SESSION['department'] == 'IT') { ?>
                <div id="ITstudentview">
                <div class="p-3">
                    <?php include 'php/itstudent-view.php'; 
                        if (mysqli_num_rows($res) > 0 ) { ?>
                    <h1 class="display-4 fs-1 text-center">IT Student Submissions</h1>
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
                            <th scope="col">Add Comment</th>
                            <th scope="col">Add Status</th>
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
                                <td data-label="Add Comment">
                                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addcomment<?php echo $rows['sID']?>">Comment</a>
                                <!-- Modal -->
                                    <div class="modal fade" id="addcomment<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-add.php" method="post">
                                        <input type="hidden" name="commentid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Comment</span>
                                            <input type="text" name="comment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addcomment" class="btn btn-primary">Comment</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                                <td data-label="Add Status"><a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addstatus<?php echo $rows['sID']?>">Status</a>
                                <!-- Modal Add Status-->
                                <div class="modal fade" id="addstatus<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-addstatus.php" method="post">
                                        <input type="hidden" name="statusid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Add Status</span>
                                            <select class="form-select" name="status">
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addstatus" class="btn btn-primary">Add</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                <!-- End Modal Add Status -->
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++;} ?>
                    </table>
                    <?php } ?>
                </div>
                </div>
                <hr>
                <div id="boxchat">
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
                    <?php include 'php/messageIT-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    </br>
                    <div class="display-chat">
                        <?php 
                            $i=1;
                            while ($rows = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="message">
                            <p>
                                <span><?php echo $rows['name']; ?> :</span>
                                <?php echo $rows['msg']; ?>
                            </p>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <?php }else{ ?>
                        <div class="message">
                            <p>
                                No previous chat available.
                            </p>
                        </div>
                    <?php } ?>
                    <form class="mt-2" method="post" action="php/messagefacultyIT.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg" class="form-control" placeholder="Type your message here..."></textarea>
                            </div>
                                    
                            <div class="col-sm-2">
                                <button type="submit" name="sendmsg" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }else if($_SESSION['department'] == 'Business'){ ?>
                <div id="Businessstudentview">
                <div class="p-3">
                    <?php include 'php/businessstudent-view.php'; 
                        if (mysqli_num_rows($res) > 0 ) { ?>
                    <h1 class="display-4 fs-1 text-center">Business Student Submissions</h1>
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
                            <th scope="col">Add Comment</th>
                            <th scope="col">Add Status</th>
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
                                <td data-label="Add Comment">
                                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addcomment<?php echo $rows['sID']?>">Comment</a>
                                <!-- Modal -->
                                    <div class="modal fade" id="addcomment<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-add.php" method="post">
                                        <input type="hidden" name="commentid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Comment</span>
                                            <input type="text" name="comment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addcomment" class="btn btn-primary">Comment</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                                <td data-label="Add Status"><a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addstatus<?php echo $rows['sID']?>">Status</a>
                                <!-- Modal Add Status-->
                                <div class="modal fade" id="addstatus<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-addstatus.php" method="post">
                                        <input type="hidden" name="statusid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Add Status</span>
                                            <select class="form-select" name="status">
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addstatus" class="btn btn-primary">Add</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal Add Status -->
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++;} ?>
                    </table>
                    <?php } ?>
                </div>
                </div>
                <hr>
                <div id="boxchat">
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
                    <?php include 'php/messageBusiness-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    </br>
                    <div class="display-chat">
                        <?php 
                            $i=1;
                            while ($rows = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="message">
                            <p>
                                <span><?php echo $rows['name']; ?> :</span>
                                <?php echo $rows['msg']; ?>
                            </p>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <?php }else{ ?>
                        <div class="message">
                            <p>
                                No previous chat available.
                            </p>
                        </div>
                    <?php } ?>
                    <form class="mt-2" method="post" action="php/messagefacultyBusiness.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg" class="form-control" placeholder="Type your message here..."></textarea>
                            </div>
                                    
                            <div class="col-sm-2">
                                <button type="submit" name="sendmsg" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <?php }else if($_SESSION['department'] == 'Designer'){ ?>
                <div id="Designerstudentview">
                <div class="p-3 mb-5">
                    <?php include 'php/designerstudent-view.php'; 
                        if (mysqli_num_rows($res) > 0 ) { ?>
                    <h1 class="display-4 fs-1 text-center">Designer Student Submissions</h1>
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
                            <th scope="col">Add Comment</th>
                            <th scope="col">Add Status</th>
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
                                <td data-label="Add Comment">
                                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addcomment<?php echo $rows['sID']?>">Comment</a>
                                <!-- Modal Add Comment-->
                                    <div class="modal fade" id="addcomment<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-add.php" method="post">
                                        <input type="hidden" name="commentid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Comment</span>
                                            <input type="text" name="comment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addcomment" class="btn btn-primary">Comment</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                <!-- End Modal Add Comment -->
                                </td>
                                <td data-label="Add Status"><a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addstatus<?php echo $rows['sID']?>">Status</a>
                                <!-- Modal Add Status-->
                                <div class="modal fade" id="addstatus<?php echo $rows['sID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="php/faculty-addstatus.php" method="post">
                                        <input type="hidden" name="statusid" value="<?=$rows['sID']?>">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Add Status</span>
                                            <select class="form-select" name="status">
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addstatus" class="btn btn-primary">Add</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal Add Status -->
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++;} ?>
                    </table>
                    <?php } ?>
                </div>
                </div>
                <hr>
                <div id="boxchat">
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
                    <?php include 'php/messageDesigner-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    </br>
                    <div class="display-chat">
                        <?php 
                            $i=1;
                            while ($rows = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="message">
                            <p>
                                <span><?php echo $rows['name']; ?> :</span>
                                <?php echo $rows['msg']; ?>
                            </p>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <?php }else{ ?>
                        <div class="message">
                            <p>
                                No previous chat available.
                            </p>
                        </div>
                    <?php } ?>
                    <form class="mt-2" method="post" action="php/messagefacultyDesigner.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg" class="form-control" placeholder="Type your message here..."></textarea>
                            </div>
                                    
                            <div class="col-sm-2">
                                <button type="submit" name="sendmsg" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </section>
        </div>
    </div>
    



    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>
<?php }else{
    header("Location: index.php");
} ?>

