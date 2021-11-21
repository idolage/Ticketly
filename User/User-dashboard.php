<?php
require_once 'includes/header.inc.php';
require_once 'includes/dbh.inc.php'; 
$id = $_SESSION['userid'];
?>
<body onload=display_ct();>
<div class="card">
    <div class="text-right p-3 font-weight-bolder" style="font-size: 20px;">
    <span id='ct'></span>
    </div>
    <div class="p-3 font-weight-bolder">
        <p style="font-size:15px;" class="text-left text-primary">Welcome to the Ticketly Online Ticketing System</p>
    </div>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "invalidGender") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Invalid Value in Gender Field!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "invaliduid") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Invalid Username!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "stmtfailed") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Cannot connect to the database!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "invalidFormat") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Invalid name format!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "invalidNo") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Invalid telephone number!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "invalidemail") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Invalid Email!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "missmatchpwd") {
                echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Passwords don't match!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "none") {
                echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Profile Details Successfully Updated!</strong>
                    </div>"; 
            }
            if ($_GET["error"] == "none2") {
                echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Password Successfully Updated!</strong>
                    </div>"; 
            }
        }
    ?>

    <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3">
                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Profile Details</span>
                            <a href="" data-toggle="modal" data-target="#EditProfileModal"><i class="fa fa-edit text-primary">&nbsp;<span style="font-size: 12px;">Edit</span></i></a>
                        </h5>
                        <div class="card-body text-secondary ">
                            <table class="table table-borderless">
                            <tbody>
                                <tr >
                                    <td>User ID</td>
                                    <td><?php echo($_SESSION["userid"]);?></td>
                                </tr>
                                <tr>
                                    <td>Full Name</td>
                                    <td translate='no'>
                                    <?php 
                                        $sql = "SELECT usersName FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersName"];
                                        $_SESSION["userName"] = $row["usersName"];
                                    }   
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Userame</td>
                                    <td translate='no'>
                                    <?php 
                                        $sql = "SELECT usersUid FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersUid"];
                                        $_SESSION["useruid"] = $row["usersUid"];
                                    }   
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                    <?php 
                                        $sql = "SELECT usersEmail FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersEmail"];
                                        $_SESSION["userEmail"] = $row["usersEmail"];
                                    }   
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td>
                                    <?php 
                                        $sql = "SELECT contactNo FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ( $row["contactNo"] == 0 ){echo"<i><a href='' class='text-primary' data-toggle='modal' data-target='#EditProfileModal'>Add Info</i></a>";}
                                            else{
                                                echo '0'.$row["contactNo"];
                                                $_SESSION["contactNo"] = $row["contactNo"];
                                            } 
                                    }   
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>
                                    <?php 
                                        $sql = "SELECT gender FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ( $row["gender"] == NULL ){
                                                echo"<i><a href='' class='text-primary' data-toggle='modal' data-target='#EditProfileModal'>Add Info</i></a>";
                                            }
                                            else{
                                                
                                                if($row["gender"] == 'M') {echo "Male";}
                                                if($row["gender"] == 'F') {echo "Female";}
                                                if($row["gender"] == 'O') {echo "Other";}
                                                $_SESSION["gender"] = $row["gender"];
                                            } 
                                    }   
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Joined on</td>
                                    <td>
                                    <?php 
                                        $sql = "SELECT created_at FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["created_at"];
                                    }   
                                    ?>
                                    </td>
                                </tr>
                            </tbody>
                            </table> 
                        </div>
                        <div class="card-footer bg-transparent">
                        <p class="text-right"><a href="" data-toggle ="modal" data-target="#ChangePwdModal" class ="text-primary">Click here to change password</a></p>
                        </div>

                        </div>
                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Notification Panel</span> 
                        </h5>

                        <div class="card-body table-responsive" style="max-height: 50vh;">
                        <table class="table table-striped table-hover">
                            <thead class="text-center">
                                <th>#</th>
                                <th>Notification</th>
                            </thead>
                            <tbody>
                            <?php    
                                $sql = "SELECT * FROM notifications ORDER BY notNo DESC;";
                                $i = 0;
                                $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;
                                    $dt = new DateTime($row['date']);
                                    $date1 = $dt->format('d/m/Y');
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td><strong>".$row['title']."</srtrong><br>
                                                    ".$row['content']."<br>
                                                    <div class='text-right'> <i>
                                                    ".$date1."</i></div>
                                                    </td>
                                                </tr>
                                        ";
                                    }

                            if ($i == 0)
                            {echo "<tr><td colspan='2' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";}
                        ?>
                    </tbody>                    
                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--Edit Profile modal start-->
<div class="modal fade" id="EditProfileModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header bg-dark">
                      <h6 class="modal-title text-light">Edit Profile Info</h6>
                      <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body ">
                      <form action="includes/editInfo.inc.php" method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="<?php 
                                        $sql = "SELECT usersName FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersName"];}
                                    ?>" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label>Gender</label>
                                <select class="custom-select" name="gender" >
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Username</label>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <input type="text" class="form-control" name="uid" value="<?php 
                                        $sql = "SELECT usersUid FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersUid"];}
                                    ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="contactNo" value="<?php 
                                        $sql = "SELECT contactNo FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["contactNo"];}
                                    ?>" required> 
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php 
                                        $sql = "SELECT usersEmail FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["usersEmail"];}
                                    ?>" required>   
                        </div>

                        <div class="form-group row justify-content-center">
                          <button class="btn btn-success" type="submit " name="submit">Save Changes</button>                                
                      </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!--edit profile modal end-->

      <!--Password change modal -->
      <div class="modal fade" id="ChangePwdModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header bg-dark">
                      <h6 class="modal-title text-light">Change Password</h6>
                      <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body ">
                  <form action="includes/changePwd.inc.php" method="post">

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="npwd" placeholder="New Password" required/>
                        </div>

                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="nrpwd" placeholder="Confirm New Password" required>
                        </div>

                        <div class="form-group row justify-content-center">
                          <button class="btn btn-success" type="submit " name="submit">Change Password</button>                                
                        </div>

                    </form>
                  </div>
              </div>
          </div>
      </div>
      <!--Password change modal -->

</div>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
var x1=x.toUTCString();// changing the display to UTC string
document.getElementById('ct').innerHTML = x1;
tt=display_c();
 }
</script>
<?php
require_once 'includes/footer.inc.php';
?>