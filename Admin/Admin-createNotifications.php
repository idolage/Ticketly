<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
            <h6><strong>Notifications</strong></h6>
    </div>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "stmtfailed") {
                echo "<div class= 'alert alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Error - Cannot connect to the database, Please try again!</strong>
                </div>"; 
            }
            if ($_GET["error"] == "none1") {
                echo "<div class= 'alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Notifications Successfully Added!</strong>
                </div>"; 
            }
            if ($_GET["error"] == "none2") {
                echo "<div class= 'alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Notifications Successfully Deleted!</strong>
                </div>"; 
            }
            if ($_GET["error"] == "notNumeric") {
                echo "<div class= 'alert alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Deletion Error - All notification nos should be numerics or null!</strong>
                </div>"; 
            }
        }
    ?>
    <div class="card-body">
        <h6><strong>Actions</strong></h6>
        <div class="row">
            <div class="col-md-3 col-12">
                <button type="button" data-toggle="modal" data-target="#AddModal" class="btn btn-success col-12">Create Notification</button>
            </div>
            <div class="col-md-3 col-12">
                <button type="button" data-toggle="modal" data-target="#DeleteModal" class="btn btn-danger col-12">Delete Notification</button>
            </div>
        </div>

        <br>

        <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th style="width:8.33%">#</th>
                        <th style="width:8.33%">Date</th>
                        <th>Notification</th>
                        <th style="width:20%">Admin Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM notifications ORDER BY date DESC;";
                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                        while ($row = mysqli_fetch_assoc($result)) {
                            $adminID = $row['adminID'];
                            $sql2 = "SELECT adminsName FROM admins WHERE admisId= '$adminID';";
                            $result2 = mysqli_query($conn, $sql2) or die( mysqli_error($conn));
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo "<tr>
                                        <td>".$row['notNo']."</td>
                                        <td>".date("Y-m-d",strtotime($row['date']))."</td>
                                        <td><strong>".$row['title']."</strong>
                                        <br>
                                        ".$row['content']."
                                        </td>
                                        <td>".$row2['adminsName']."</td>                                      
                                        
                                     </tr>";
                            }
                        }
                    ?>
                </tbody>
        </table>

        <!--AddModal-->
        <div class="modal fade" id="AddModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h6 class="modal-title text-light">Create New Notification</h6>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body ">
                <form action="includes/createNotification.inc.php" method="post">
                    <div class="form-group row">
                        <h6 ><strong>Title</strong></h6>
                        <input type="text" class="form-control" name="title" required>  
                    </div> 
                    <div class="form-group row">
                        <h6 ><strong>Description</strong></h6>
                        <textarea class="form-control" name="content"></textarea> 
                    </div> 
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-success" input type="submit " name="submit" style="width: 250px;">Save Notification</button>                                
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
        
         <!--DeleteModal-->
         <div class="modal fade" id="DeleteModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h6 class="modal-title text-light">Delete Notification</h6>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body ">
                <form action="includes/deleteNotification.inc.php" method="post">
                    <div class="form-group row col-10">
                        <h6 ><strong>Enter Notification Number(s) To Delete</strong></h6>  
                    </div> 
                    <div class="form-group row col-10">
                        <input type="text" class="form-control" name="n1" placeholder="Notification 01.." required> 
                    </div> 
                    <div class="form-group row col-10">
                        <input type="text" class="form-control" name="n2" placeholder="Notification 02.."> 
                    </div> 
                    <div class="form-group row col-10">
                        <input type="text" class="form-control" name="n3" placeholder="Notification 03.."> 
                    </div> 
                    <div class="form-group row col-10">
                        <input type="text" class="form-control" name="n4" placeholder="Notification 04.."> 
                    </div> 
                    <div class="form-group row col-10">
                        <input type="text" class="form-control" name="n5" placeholder="Notification 05.."> 
                    </div> 
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-danger" input type="submit " name="submit" style="width: 250px;">Delete Notification</button>                                
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>