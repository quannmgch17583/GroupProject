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

    <title>Admin Panel</title> 
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
    <div class="container-fluid justify-content-center">
        <div class="wrapper">
            <input type="checkbox" id="check">
            <label for="check">
                <i class="fas fa-bars" id="btn"></i>
                <i class="fas fa-times" id="cancel"></i>
            </label>
            <section class="sidebar">
                <header id="headersidebar"></header>
                <ul class="nav-bar">
                    <li><a href="admin-panel.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#add" href="#"><i class="fas fa-user-plus"></i>&nbsp;Add Members</a></li>
                    <li><a href="#sectionview"><i class="fas fa-users"></i>&nbsp;View Members</a></li>
                    <li><a href="#deadline"><i class="far fa-file"></i>&nbsp;View Contributions</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#addcontribution" href="#"><i class="fas fa-file-upload"></i>&nbsp;Upload Contributions</a></li>
                    <li><a href="#deadline"><i class="fas fa-cogs"></i>&nbsp;Backup</a></li>
                </ul>
            </section>
            <section class="working-panel">
                <!-- Modal Add Account -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="php/insert.php" method="post">
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                                        <input type="text" name="nusername" class="form-control" placeholder="Enter the username">
                                    </div>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                                        <input type="password" name="npassword" class="form-control" placeholder="Enter the password">
                                    </div>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                                        <input type="text" name="nname" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Department</span>
                                    <?php 
                                        $sql = "SELECT * FROM department";
                                        $res = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($res) > 0 ) { ?>
                                        <select class="form-select mb-3" name="ndepartment">
                                            <option value="" selected>--Choose Department--</option>
                                            <?php 
                                                $i=1;
                                                while($rows = mysqli_fetch_assoc($res)) { ?>
                                            <option value="<?=$rows['department']?>"><?=$rows['department']?></option>
                                            <?php $i++; }?>
                                        </select>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                                    <?php 
                                        $sql = "SELECT * FROM role";
                                        $res = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($res) > 0) { ?>
                                        <select class="form-select mb-3" name="nrole">
                                        <?php                                         
                                        $i=1;
                                        while($rows = mysqli_fetch_assoc($res)) { ?>
                                            <option value="<?=$rows['role']?>"><?=$rows['role']?></option>
                                        <?php $i++; } ?>
                                        </select>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="insertdata" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
                <!-- End Modal Add Account -->

                <!-- Modal Add Contribution -->
                <div class="modal fade" id="addcontribution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add contribution</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="php/contribution-add.php" method="post">
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Contribution Name</span>
                                    <input type="text" name="ncName" class="form-control" required/>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                                    <input type="text" name="ncDes" class="form-control" required/>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Start Date</span>
                                    <input type="date" name="ncStartDate" class="form-control" required/>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">End Date</span>
                                    <input type="date" name="ncEndDate" class="form-control" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="insertcontribution" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                <!-- End Modal Add Contribution -->

            <div id="sectionview" style="margin-top: 50px;">    
                <div class="p-3">
                    <?php include 'php/members.php'; 
                        if (mysqli_num_rows($res) > 0 ) { ?>
                    <h1 class="display-4 fs-1 text-center">Members</h1>
                    <table class="table table-dark" style="width: 100%; margin: auto;">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Department</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i= 1;
                            while ($rows = mysqli_fetch_assoc($res)) { 
                                
                        ?>
                            <tr>
                                <td data-label="ID" scope="row"><?=$i?></td>
                                <td data-label="Username" class="table-active"><?=$rows['username']?></td>
                                <td data-label="Name" class="table-active"><?=$rows['name']?></td>
                                <td data-label="Role"><?=$rows['role']?></td>
                                <td data-label="Department"><?=$rows['department']?></td>
                                <td data-label="Edit">
                                    <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#update_modal<?php echo $rows['id']?>">Update</a>
                                    <div class="modal fade" id="update_modal<?php echo $rows['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="php/update.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="eid" value="<?=$rows['id']?>"/>
                                                    <div class="mb-3">
                                                        <label>Username</label>
                                                        <input type="text" name="eusername" class="form-control" value="<?=$rows['username']?>" placeholder="Enter the username"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Password</label>
                                                        <input type="password" name="epassword" class="form-control" value="<?=$rows['password']?>" placeholder="Enter the password"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" name="ename" class="form-control" value="<?=$rows['name']?>" placeholder="Name"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Department</span>
                                                        <select class="form-select mb-3" name="edepartment">
                                                            <option value="" selected>--Choose Department--</option>
                                                            <option value="IT">IT</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                                                        <select class="form-select mb-3" name="erole">
                                                            <option selected value="admin">Admin</option>
                                                            <option value="manager">Marketing Manager</option>
                                                            <option value="coordinator">Marketing Coordinator</option>
                                                            <option value="student">Student</option>
                                                            <option value="guest">Guest</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Delete"><a href="php/delete.php?Del=<?=$rows['id']?>" onclick="return confirm('Are you sure to delete this account?')" class="btn btn-danger">Delete</a></td>
                            </tr>
                        </tbody>
                        <?php $i++;} ?>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <hr>
            
            <div id="deadline">
                    <div class="p-3">
                            <?php include 'php/contribution.php';
                                if (mysqli_num_rows($res) > 0 ) { ?>
                            <h1 class="display-4 fs-1 text-center">Contributions</h1>
                            <table class="table table-dark" style="width: 100%; margin: auto;">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Contribution Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <?php 
                                $i= 1;
                                while ($rows = mysqli_fetch_assoc($res)) { ?>
                                <tbody>
                                    <tr>
                                        <td data-label="ID" scope="row"><?=$rows['cID']?></td>
                                        <td data-label="Contribution Name" class="table-active"><?=$rows['cName']?></td>
                                        <td data-label="Description"><?=$rows['cDes']?></td>
                                        <td data-label="Start Date"><?=$rows['cStartDate']?></td>
                                        <td data-label="End Date"><?=$rows['cEndDate']?></td>
                                        <td data-label="Edit"><a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#update_contribution<?php echo $rows['cID']?>">Update</a>
                                        <div class="modal fade" id="update_contribution<?php echo $rows['cID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Contribution</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="php/contribution-update.php" method="post">
                                                    <div class="modal-body">
                                                    <input type="hidden" name="ucID" value="<?=$rows['cID']?>">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Contribution Name</span>
                                                        <input type="text" name="ucName" value="<?=$rows['cName']?>"class="form-control" required/>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                                                        <input type="text" name="ucDes" value="<?=$rows['cDes']?>" class="form-control" required/>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Deadline</span>
                                                        <input type="date" name="ucStartDate" value="<?=$rows['cStartDate']?>" class="form-control" required/>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Deadline</span>
                                                        <input type="date" name="ucEndDate" value="<?=$rows['cEndDate']?>" class="form-control" required/>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="updatecontribution" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td data-label="Delete"><a href="php/contribution-delete.php?Del=<?=$rows['cID']?>" onclick="return confirm('Are you sure to delete this contribution?')" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                </tbody>
                                <?php $i++; } ?>
                                </table>
                            <?php } ?>
                    </div>
            </div>     
            <br>
            <br>
            <br>
            <br>
            <hr>

            <div id="dbb">               
					<div class="col-sm-12 col-xs-12">
						<div class="mt-3">
									<h3 class="text-center">Database Backup</h3>
						</div>	
							<form action="php/database_backup.php" method="post" id="" style="width:300px; margin: auto;">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label" >Host</label>
                                        <input type="text" class="form-control" placeholder="Enter Server Name EX: Localhost" name="server" id="server" required="" autocomplete="on">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label" >Database Username</label>
                                        <input type="text" class="form-control" placeholder="Enter Database Username EX: root" name="username" id="username" required="" autocomplete="on">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label" >Database Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Database Password" name="password" id="password" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Database Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Database Name" name="dbname" id="dbname" required="" autocomplete="on">
                                    </div>
                                </div>
                                <div class="mb-3">
                                        <div class="form-group text-center">
                                        <button type="submit" name="backupnow" class="btn btn-success">Initiate Backup</button>
                                    </div>
                                </div>
							</form>
					</div>	
            </div>               
            </section>
        </div>
    </div>
    

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>
<?php }else{
    header("Location: index.php");
} ?>

