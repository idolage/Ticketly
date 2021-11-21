<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$trainNo = $_GET['trainNo'];
$trainName = $_GET['trainName'];
?>
<div class="col d-flex justify-content-center">
    <div class="card border-primary mb-3 " style="min-width: 50vw; max-height:90vh;">
        <div class="card-header bg-primary text-light text-center"><h5><?php echo $trainNo," - ",$trainName;?></h5></div>
        <div class="card-body table-responsive table-hover">
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "none_2") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Train Schedule Record Successfully Updated!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "none_1") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Train Schedule Record Successfully Added!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "none_3") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Train Schedule Record Successfully Deleted!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "none_4") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Train Schedule Successfully Deleted!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "invalidTime") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Both arrival and departure time cannot be null!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "sameTime") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Both arrival and departure time cannot be the same!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "Norec") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Invalid record no!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "recordExist") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Record already exists in the schedule!</strong>
                        </div>"; 
                    }
                    if ($_GET["error"] == "stmtfailed") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Cannot connect to the database!</strong>
                        </div>"; 
                    }
                }
            ?>
            
            <h6><strong>Actions</strong></h6>
            <div class="row">
                <div class="col-md-3 col-12">
                    <button type="button" data-toggle="modal" data-target="#AddModal" class="btn btn-primary col-12">Add Record</button>
                </div>
                <div class="col-md-3 col-12">
                    <button type="button" data-toggle="modal" data-target="#EditModal" class="btn btn-success col-12">Edit Record</button>
                </div>
                <div class="col-md-3 col-12">
                    <button type="button" data-toggle="modal" data-target="#DeleteRecordModal" class="btn btn-warning col-12">Delete Record</button>
                </div>
                <div class="col-md-3 col-12">
                    <button type="button" data-toggle="modal" data-target="#DeleteModal" class="btn btn-danger col-12">Delete Schedule</button>
                </div>
            </div>
            <br>
            <h6><strong>Train Schedule</strong></h6>
            <form class="d-flex" action="includes/searchSchedule.inc.php?trainNo=<?php echo $trainNo?>&trainName=<?php echo $trainName?>" method="POST">
                <div class="input-group">
                    <button class="btn btn-secondary text-light" disabled ><i class="fa fa-search fa-lg"></i></button>
                    <input type="text" name="location" class="form-control" placeholder="Search By Station Name...">
                    <button class="btn btn-outline-primary" type="submit" name="submit">Search</button>
                </div>
            </form>
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "Noresults") {
                        echo "<div class= 'alert alert-info'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong><i class='fa fa-search fa-lg'></i> Sorry, no matched results!</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "results") {
                        echo "<div class= 'alert alert-info'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong><i class='fa fa-search fa-lg'></i> Matched result
                        <table class='table-responsive table-sm'>
                            <tr>
                                <td>Searched Station</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>".$_GET['location']."</td>
                            </tr>
                            <tr>
                                <td>Record No</td>
                                <td> </td>
                                <td>".$_GET['recNo']."</td>
                            </tr>
                            <tr>
                                <td>Arrival</td>
                                <td> </td>"; $d=strtotime($_GET['aTime']);
                                echo "<td>".date("h:i a", $d)."</td>
                            </tr>
                            <tr>
                                <td>Departure</td>
                                <td> </td>";$d=strtotime($_GET['dTime']);
                                echo "<td>".date("h:i a", $d)."</td>
                            </tr>
                        </table>
                        </strong>
                        </div>";
                    }
                }
            ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Record No</th>
                        <th>Station Name</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM schedules WHERE trainNo = $trainNo ORDER BY dTime ASC;";
                        $i = 0;
                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                        while ($row = mysqli_fetch_assoc($result)) {
                            $i++;
                            echo "  <tr>
                                        <td>".$i."</td>
                                        <td>".$row['recNo']."</td>
                                        <td>".$row['arrival']."</td>";
                                        if ($row['aTime'] != '00:00:00')
                                        {
                                            $d=strtotime($row['aTime']);
                                            echo "<td>".date("h:i a", $d)."</td>";
                                        }
                                        else
                                        {echo "<td></td>"; }

                                        if ($row['dTime'] != '00:00:00')
                                        {
                                            $d=strtotime($row['dTime']);
                                            echo "<td>".date("h:i a", $d)."</td>";
                                        }
                                        else
                                        {echo "<td></td>"; }
                             echo  "</tr>";
                        }

                        if ($i == 0)
                        {
                            echo "<tr><td colspan='5' class='text-center'><strong><i>Information Needed!</i></strong></td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
</div>

<!--AddModal-->
<div class="modal fade" id="AddModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-light">Add New Record To '<?php echo $trainNo," - ",$trainName?>' Train Schedule</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/addShedule.inc.php?trainNo=<?php echo $trainNo?>&trainName=<?php echo $trainName?>" method="post">
                    <p class='text-primary' style="font-size: 15px;">Fill in details</p>
                    <div class="form-group row">
                        <div class="col">
                            <h6 class='text-primary'><i class='fa fa-map-marker'></i> Train Station</h6>
                            <input type="text" class="form-control" placeholder="Enter Location/ Station" name="location" required>  
                        </div>                              
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <br>
                            <h6 class='text-primary'><i class='fa fa-clock-o'></i> Select Arrival Time</h6>
                        </div> 
                        <div class="col">
                            <br>
                            <input type="time" class="form-control" name="aTime">  
                        </div>                               
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <br>
                            <h6 class='text-primary'><i class='fa fa-clock-o'></i> Select Departure Time</h6>
                        </div>
                        <div class="col">
                            <br>
                            <input type="time" class="form-control" name="dTime">    
                        </div>                            
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-primary" input type="submit " name="submit" style="width: 250px;">Add Record</button>                                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--- EditModal --->
<div class="modal fade" id="EditModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title text-light">Edit '<?php echo $trainNo," - ",$trainName?>' Train Record</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/editScheduleRecord.inc.php?trainNo=<?php echo $trainNo?>&trainName=<?php echo $trainName?>" method="post">
                <p class='text-success' style="font-size: 15px;">Fill in details</p>
                <div class="form-group row">
                <div class="col">
                    <h6 class='text-success'><i class='fa fa-train'></i> Record No</h6>
                    <input type="text" class="form-control" name="recNo" placeholder="Enter Relevant Record No" required>
                    </div>                               
                </div>
                <br> 
                <div class="form-group row">
                <div class="col">
                    <h6 class='text-success'><i class='fa fa-map-marker'></i> Train Station</h6>
                    <input type="text" class="form-control" placeholder="Enter Location/ Station" name="location" required> 
                    </div>                               
                </div>
                <div class="form-group row">
                    <div class="col">
                        <br>
                        <h6 class='text-success'><i class='fa fa-clock-o'></i> Select Arrival Time</h6>
                    </div>
                    <div class="col">
                    <br>
                        <input type="time" class="form-control" name="aTime">     
                    </div>                           
                </div>
                <div class="form-group row">
                    <div class="col">
                        <br>
                        <h6 class='text-success'><i class='fa fa-clock-o'></i> Select Departure Time</h6>
                    </div>
                    <div class="col">
                        <br>
                        <input type="time" class="form-control" name="dTime">    
                    </div>                            
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <button class="btn btn-success" input type="submit" name="submit">Save Changes</button>                               
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--- DeleteRecordModal --->
<div class="modal fade" id="DeleteRecordModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title ">Remove A Single Record From The '<?php echo $trainNo," - ",$trainName?>' Train Schedule</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/deleteRecord.inc.php?trainNo=<?php echo $trainNo?>&trainName=<?php echo $trainName?>" method="post">
                    <p style="font-size: 15px;">Click Delete button to delete the record from the database. Please note that once you click Delete the action is not reversable.</p>
                    
                    <div class="form-group row">
                        <div class="col">
                            <h6><i class='fa fa-train'></i> Record No</h6>
                            <input type="text" class="form-control" name="recNo" placeholder="Enter Relevant Record No" required>
                        </div>                               
                    </div>
                    <br> 
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-warning" input type="submit" name="submit">Delete</button>                                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--- DeleteModal --->
<div class="modal fade" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-light">Remove '<?php echo $trainNo," - ", $trainName?>' Train Schedule From The Database</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/deleteSchedule.inc.php?trainNo=<?php echo $trainNo?>&trainName=<?php echo $trainName?>" method="post">
                    <p style="font-size: 15px;">Click Delete button to delete all records from '<?php echo $trainNo," - ",$trainName?>' train schedule. Please note that once you click Delete the action is not reversable.</p>
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-danger" input type="submit" name="yes">Delete</button>                                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
require_once 'includes/footer.inc.php';
?>