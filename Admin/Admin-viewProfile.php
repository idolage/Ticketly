<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
$name = $created_at = $email = $uid =  '';
$id = $_SESSION['userid'];
$sql = "SELECT * FROM admins WHERE admisId = $id;";
$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
while ($row = mysqli_fetch_assoc($result))  
{
    $name = $row['adminsName'];
    $created_at = $row['created_at'];
    $email = $row['adminsEmail'];
    $uid = $row['adminsUid'];
    $tel = $row['contact_no'];
    $position = $row['position'];
}

$sql = "SELECT admin_photo FROM admins WHERE admisId = $id;";
$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
while ($row = mysqli_fetch_assoc($result))  
{
    $photo = $row['admin_photo'];
}

?>
<div class="row flex-lg-nowrap">
    <div class="col">
        <div class="row">
            <div class="col mb-3">
                <div class="card">
                    <div class="card-body">
                    <?php

                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "none_1") {
                                echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Profile Photo Successfully Updated!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "invalidemail") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating details - Invalid email! Please use a valid email address</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "invalidTel") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating details - Invalid contact number! Please enter a valid telephone/mobile number</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "invaliduid") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating details - Invalid username!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "uidexist") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating details - Username or Email already taken by another user!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "stmtfailed") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating details - Cannot connect to the database! Please try again later</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "none") {
                                echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Profile Details Successfully Updated!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "missmatchpwd") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating password - Passwords does not match!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "samepwd") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating password - Old password cannot be new password!</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "stmtfailed_3") {
                                echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Error while updating password - Cannot connect to the database! Please try again later</strong>
                                </div>";
                            }
                            if ($_GET["error"] == "none_3") {
                                echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Password Successfully Updated!</strong>
                                </div>";
                            }
                        }
                    ?>
                    
                        <form action="includes/updatePhoto.inc.php" method="POST" enctype="multipart/form-data" id="profile-photo-form">
                            <input type="hidden" name="form3" value="Update">
                            <div style="background-image: url('img/hero-bg.png'); background-size: cover;">
                                <div class="text-center text-sm-left">
                                    <span class="badge badge-info">administrator</span>
                                    <div class="text-muted">
                                        <small>Joined <?= date('d M Y', strtotime($created_at)); ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <?php
                                            if ($photo!=null) { ?>
                                            <img style="width: 200px;" class="rounded-circle"
                                                src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($photo); ?>" />
                                            <?php } 
                                            else { ?>
                                            <img style="width: 200px;" class="rounded-circle" src="img/default-user-image.png" alt="...">
                                            <?php } 
                                        ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row d-flex justify-content-center">
                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><strong translate='no'><?php echo $name;?></strong></h4>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <h6 class="mb-0 text-primary"><strong translate='no'>@<?php echo $uid;?></strong></h6>
                                </div>
                                <div class="row">
                                    <div class="mt-2">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="btn btn-success buttonimg" onclick="document.getElementById('admin_photo').click()"><i class="fa fa-fw fa-camera"></i><span>Change Photo</span></label>
                                        <input type='file' id="admin_photo" style="display:none" name="file" class="buttonimg">
                                        <div class="btn-group btn-group-toggle mb-1" data-toggle="buttons">
                                            <p id="chosenfile">&nbsp;</p>&nbsp;&nbsp;
                                            <button type="submit" name="btn-upload" class="btn btn-success">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            var input = document.getElementById('admin_photo');
                            var infoArea = document.getElementById('chosenfile');

                            input.addEventListener('change',showFileName);

                            function showFileName(event){
                                var input = event.srcElement;
                                var fileName = input.files[0].name;
                                infoArea.textContent = 'Selected File: ' + fileName;
                            }
                        </script>
                        <div class="tab-content pt-3">
                            <div class="mb-2"><b>Update Profile</b></div>
                            <div class="tab-pane active">
                                <form class="form" method="POST" action="includes/updateProfile.inc.php" id="form">
                                    <input type="hidden" name="form1" value="Update">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input class="form-control" type="text"
                                                                        name="admin_name"
                                                                        value="<?php echo $name?>"
                                                                        id="admin_name" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input class="form-control" type="text"
                                                                        name="admin_username"
                                                                        value=<?php echo $uid;?>
                                                                        required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" type="text"
                                                                        name="admin_email"
                                                                        value=<?php echo $email;?>
                                                                        id="admin_eemail"
                                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Contact No</label>
                                                        <input class="form-control" type="text"
                                                                        name="tel"
                                                                        value="0<?php echo $tel?>"
                                                                        id="tel" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <input class="form-control" type="text"
                                                                        name="position"
                                                                        value='<?php echo $position;?>'
                                                                        required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col d-flex justify-content">
                                                    <input type="submit" name="profile_update"
                                                                    value="Save Changes" class="btn btn-success savebtn"
                                                                    id="ProfileUpdateBtn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                                <form class="form" method="POST" action="includes/changePassword.inc.php" id="password-update-form">
                                    <input type="hidden" name="form2" value="UpdatePass">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="mb-2"><b>Change Password</b></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input class="form-control" type="password"
                                                                        placeholder="Current Password"
                                                                        name="admin_cpass" id="admin_cpass" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input required class="form-control" type="password"
                                                                        placeholder="New Password" name="admin_npass"
                                                                        id="admin_npass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                                        <input class="form-control" type="password"
                                                                        placeholder="Re-Enter Password"
                                                                        name="admin_cnpass" id="admin_cnpass" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex justify-content">
                                            <input type="submit" name="password_update"
                                                            value="Reset Password" class="btn btn-success savebtn"
                                                            id="PasswordUpdateBtn">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                    
</div>
<?php
require_once 'includes/footer.inc.php';
?>