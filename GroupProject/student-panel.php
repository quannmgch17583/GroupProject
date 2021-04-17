<?php 
    session_start();
    include "db-conn.php";
    if(isset($_SESSION['username']) && isset($_SESSION['id'])) { 
        $id = $_SESSION['id'];
        $name = $_SESSION['name']; 
        $department = $_SESSION['department'];
        $password = $_SESSION['password'];
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

    <title>Student Panel</title> 
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
                    <li><a href="student-panel.php"><i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
                    <li><a href="#studentview"><i class="far fa-file"></i>&nbsp; View Submissions</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#studentsubmit" href="#"><i class="fas fa-file-upload"></i>&nbsp; Upload Submissions</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#settings" href="#"><i class="fas fa-user-cog"></i>&nbsp; Change Password</a></li>
                </ul>
            </section>
            <section class="working-panel">        
                <div id="ssubmit">
                    <div class="modal fade" id="studentsubmit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Your Submission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="php/student-upload.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <?php if (isset($_GET['error'])): ?>
                                    <p><?php echo $_GET['error'] ?></p>
                                <?php endif ?>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Your Student ID: <?=$id?></span>
                                        <input type="hidden" name="studentID" value="<?=$id?>" class="form-control"/>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Submission Name</span>
                                        <input type="text" name="sName" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label>Type of contribution</label>
                                        <select class="form-select" name="cID" required>
                                            <option disabled>Select Contribution</option>
                                                <?php 
                                                require_once('db-conn.php');
                                                $select_contribution = "SELECT * FROM contribution";
                                                $res = mysqli_query($conn, $select_contribution);
                                                while($row = mysqli_fetch_assoc($res)) { ?>
                                                <option value="<?=$row['cID']?>"><?=$row['cName']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Your Faculty: <?=$department?></span>
                                        <input type="hidden" name="department" value="<?=$department?>" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label>Your Submission File:</label>
                                        <input type="file" name="sSubmission" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">Terms and Conditions</label>
                                    </div>
                                    <input type="hidden" name="submissionmsg" value=" has a new submission">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="supload" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

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
                                            <span class="input-group-text" id="inputGroup-sizing-default">Your Student ID: <?=$id?></span>
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
                    <div id="studentview">    
                    <div class="p-3">
                        <?php include 'php/submission.php'; 
                            if (mysqli_num_rows($res) > 0 ) { ?>
                        <h1 class="display-4 fs-1 text-center">Your Submissions</h1>
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
                                <th scope="col">Delete</th>
                                <th scope="col">Notice Faculty</th>
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
                                    <td data-label="Submission File"><a href="php/uploads/<?=$rows['sUpload']?>"><?=$rows['sUpload']?></a></td>
                                    <td data-label="Student ID"><?=$rows['studentID']?></td>
                                    <td data-label="Department" class="table-active"><?=$rows['department']?></td>
                                    <td data-label="Comment"><?=$rows['Comment']?></td>
                                    <td data-label="Status" class="table-active"><?=$rows['status']?></td>
                                    <td data-label="Delete"><a href="php/student-delete.php?Del=<?=$rows['sID']?>" onclick="return confirm('Are you sure to delete this submission?')" class="btn btn-danger">Delete</a></td>
                                    <td data-label="Notice Faculty"><a href="php/ITsubmission-notification.php?GET=<?=$_SESSION['name']?>" onclick="return confirm('Are you sure to notice your faculty?')" class="btn btn-success">Notice</a></td>
                                </tr>
                            </tbody>
                                <?php $i++;} ?>
                            </table>
                            <?php } ?>
                    </div>
                </div>
                <hr>

                <div id="boxchat">
                    <?php include 'php/messageIT-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
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
                    <form class="mt-2" method="post" action="php/messageIT-send.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg"  placeholder="Type your message here..."></textarea>
                            </div>
                                    
                            <div class="col-sm-2">
                                <button type="submit" name="sendmsg" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }else if($_SESSION['department'] == 'Designer') { ?>
                    <div id="studentview">    
                    <div class="p-3">
                        <?php include 'php/submission.php'; 
                            if (mysqli_num_rows($res) > 0 ) { ?>
                        <h1 class="display-4 fs-1 text-center">Your Submissions</h1>
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
                                <th scope="col">Delete</th>
                                <th scope="col">Notice Faculty</th>
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
                                    <td data-label="Submission File"><a href="php/uploads/<?=$rows['sUpload']?>"><?=$rows['sUpload']?></a></td>
                                    <td data-label="Student ID"><?=$rows['studentID']?></td>
                                    <td data-label="Department" class="table-active"><?=$rows['department']?></td>
                                    <td data-label="Comment"><?=$rows['Comment']?></td>
                                    <td data-label="Status" class="table-active"><?=$rows['status']?></td>
                                    <td data-label="Delete"><a href="php/student-delete.php?Del=<?=$rows['sID']?>" onclick="return confirm('Are you sure to delete this submission?')" class="btn btn-danger">Delete</a></td>
                                    <td data-label="Notice Faculty"><a href="php/Designersubmission-notification.php?GET=<?=$_SESSION['name']?>" onclick="return confirm('Are you sure to notice your faculty?')" class="btn btn-success">Notice</a></td>
                                </tr>
                            </tbody>
                                <?php $i++;} ?>
                            </table>
                            <?php } ?>
                    </div>
                </div>
                <hr>

                <div id="boxchat">
                    <?php include 'php/messageDesigner-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
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
                    <form class="mt-2" method="post" action="php/messageDesigner-send.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg"  placeholder="Type your message here..."></textarea>
                            </div>
                                    
                            <div class="col-sm-2">
                                <button type="submit" name="sendmsg" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }else if($_SESSION['department'] == 'Business') { ?>
                    <div id="studentview">    
                    <div class="p-3">
                        <?php include 'php/submission.php'; 
                            if (mysqli_num_rows($res) > 0 ) { ?>
                        <h1 class="display-4 fs-1 text-center">Your Submissions</h1>
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
                                <th scope="col">Delete</th>
                                <th scope="col">Notice Faculty</th>
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
                                    <td data-label="Submission File"><a href="php/uploads/<?=$rows['sUpload']?>"><?=$rows['sUpload']?></a></td>
                                    <td data-label="Student ID"><?=$rows['studentID']?></td>
                                    <td data-label="Department" class="table-active"><?=$rows['department']?></td>
                                    <td data-label="Comment"><?=$rows['Comment']?></td>
                                    <td data-label="Status" class="table-active"><?=$rows['status']?></td>
                                    <td data-label="Delete"><a href="php/student-delete.php?Del=<?=$rows['sID']?>" onclick="return confirm('Are you sure to delete this submission?')" class="btn btn-danger">Delete</a></td>
                                    <td data-label="Notice Faculty"><a href="php/Businesssubmission-notification.php?GET=<?=$_SESSION['name']?>" onclick="return confirm('Are you sure to notice your faculty?')" class="btn btn-success">Notice</a></td>
                                </tr>
                            </tbody>
                                <?php $i++;} ?>
                            </table>
                            <?php } ?>
                    </div>
                </div>
                <hr>

                <div id="boxchat">
                    <?php include 'php/messageBusiness-display.php';
                        if (mysqli_num_rows($res) > 0) { ?>
                    <h1 class="display-4 fs-1 text-center">BoxChat</h1>
                    <center><h2>Welcome, <span style="color:black;"> <?=$_SESSION['name']?> </span></h2></center>
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
                    <form class="mt-2" method="post" action="php/messageBusiness-send.php">
                        <div class="form-group">
                            <div>          
                                <textarea name="msg"  placeholder="Type your message here..."></textarea>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>
<?php }else{
    header("Location: index.php");
} ?>

