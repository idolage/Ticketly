<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$trainNo = $_GET['trainNo'];
$records = mysqli_query($conn,"SELECT * FROM trains WHERE trainNo = $trainNo;");
while($data=mysqli_fetch_array($records))
{
?>
<div class="col d-flex justify-content-center">
<div class="card border-primary mb-3 " style="min-width: 50vw">
  <div class="card-header bg-primary text-light text-center"><h5><?php echo $data['trainNo']," - ",$data['trainName'];?></h5></div>
  <div class="card-body">
  <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "invalidTrainNo") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid train no!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "invalidStop") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid number of stops!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "invalidDist") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid amount of distance covered by the train!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "invalidFirst") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid no of 1<sup>st</sup> class compartments!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "invalidSecond") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid no of 2<sup>nd</sup> class compartments!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "invalidThird") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Invalid no of 3<sup>rd</sup> class compartments!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "trainNoExist") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Train number already registered!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "stmtfailed") {
            echo "<div class= 'alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Error - Cannot connect to the database, Please try again!</strong>
            </div>"; 
        }
        if ($_GET["error"] == "none") {
            echo "<div class= 'alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Train Details Successfully Updated!</strong>
            </div>"; 
        }
    }
  ?>
  <h6><strong>Train Details</strong></h6>
    <p class="card-text">
        <div class="row justify-content-center">
            <div class="col-auto border border-info rounded shadow p-3 mb-5">
                <table class="table table-responsive table-borderless table-sm" style="font-weight: bold;">
                    <tr>
                        <td>Train No</td>
                        <td> - </td>
                        <td><?php echo $data['trainNo']?></td>
                    </tr>
                    <tr>
                        <td>Train Name</td>
                        <td> - </td>
                        <td><?php echo $data['trainName']?></td>
                    </tr>
                    <tr>
                        <td>Line</td>
                        <td> - </td>
                        <td><?php echo $data['lineType']?></td>
                    </tr>
                    <tr>
                        <td>Frequency</td>
                        <td> - </td>
                        <td><?php echo $data['frequency']?></td>
                    </tr>
                    <tr>
                        <td>Total no of stops</td>
                        <td> - </td>
                        <td><?php echo $data['stops']?></td>
                    </tr>
                    <tr>
                        <td>Distance covered by the train </td>
                        <td> - </td>
                        <td><?php echo $data['distance']?>&nbsp;Km</td>
                    </tr>
                    <tr>
                        <td>Train Travels</td>
                        <td> - </td>
                        <td>From <?php echo $data['startCity']?> To <?php echo $data['endCity']?></td>
                    </tr>
                </table>
            </div>
        </div> 
    </p>
    <br>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="text-center">
                <strong>Available Services</strong>
            </div>
            <table class="table table-responsive table-borderless">
                <tr>
                    <td translate='no'>A</td>
                    <td>Unreserved 2nd and 3rd Class</td>
                    <td><?php 
                    if($data['A'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['A'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>B</td>
                    <td>Restaurant / Buffet</td>
                    <td><?php 
                    if($data['B'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['B'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>C</td>
                    <td>Reserved 2nd Class</td>
                    <td><?php 
                    if($data['C'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['C'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>D</td>
                    <td>Reserved 2nd and 3rd Class Reclining Seat (Sleeperette)</td>
                    <td><?php 
                    if($data['D'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['D'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>E</td>
                    <td>Reserved 1st Class Observation</td>
                    <td><?php 
                    if($data['E'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['E'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>F</td>
                    <td>Reserved 1st Class Sleeping Berth</td>
                    <td><?php 
                    if($data['F'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['F'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td translate='no'>G</td>
                    <td>Reserved 1st class Air-conditioned coach</td>
                    <td><?php 
                    if($data['G'] == 1){
                        echo"<i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>";
                    }
                    else if ($data['G'] == 0){
                        echo"<i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>";
                    }
                    ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="text-center">
                <strong>Compartment Details</strong>
                <table class="table table-responsive table-borderless text-center">
                    <tr>
                        <td>No of 1<sup>st</sup>&nbsp;Class Compartments - <?php echo $data['firstClass']?></td>
                    </tr>
                    <tr>
                        <td>No of 2<sup>nd</sup>&nbsp;Class Compartments - <?php echo $data['second']?></td>
                    </tr>
                    <tr>
                        <td>No of 3<sup>rd</sup>&nbsp;Class Compartments - <?php echo $data['third']?></td>
                    </tr>
                </table>
                <br>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EditModal" style="width: 180px;">Edit Train Info</button>
                <br><br>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal" style="width: 180px;">Delete Train</button>
            </div>
        </div>
    </div>
  </div>
</div>    
</div>

<!--- DeleteModal --->
<div class="modal fade" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-light">Remove '<?php echo $data['trainName']?>' Train From The Database?</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/deleteTrain.inc.php?trainNo=<?php echo $data['trainNo']?>" method="post">
                <p style="font-size: 15px;">Click Delete button to delete all records regarding '<?php echo $data['trainName']?>' train from the database. Please note that once you click Delete the action is not reversable.</p>
                
                <div class="form-group row justify-content-center">
                    <button class="btn btn-success" input type="submit" name="no">Cancel</button>
                    &nbsp; &nbsp; &nbsp; &nbsp;  
                    <button class="btn btn-danger" input type="submit" name="yes">Delete</button>                                
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--- EditModal --->
<div class="modal fade" id="EditModal">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 90vw;">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-light">Edit Train Info</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/editTrain.inc.php?trainNo=<?php echo $data['trainNo']?>" method="post">
                    <div class="form-group row">
                        <div class = 'col-md-6'>
                        <br>
                            <h6><i class='fa fa-train'></i> Train No</h6>
                            <input type="text" class="form-control" name="tNo" value="<?php echo $data['trainNo']?>" required>                                
                        </div>
                        <div class="col-md-6">
                        <br>
                            <h6><i class='fa fa-train'></i> Train Name</h6>
                            <input type="text" class="form-control" name="tName" value="<?php echo $data['trainName']?>" required>                                
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class = 'col-md-6'>
                        <br>
                            <h6><i class='fa fa-map-marker'></i> Starting Station</h6>
                            <input type="text" class="form-control" name="start" value="<?php echo $data['startCity']?>" required>                                
                        </div>
                        <div class="col-md-6">
                        <br>
                            <h6><i class='fa fa-map-marker'></i> Ending Station</h6>
                            <input type="text" class="form-control" name="end" value="<?php echo $data['endCity']?>" required>                                
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class = 'col-md-6'>
                        <br>
                            <h6><i class='fa fa-map-signs'></i> No of Stops</h6>
                            <input type="text" class="form-control" name="stops" value="<?php echo $data['stops']?>" required>                                
                        </div>
                        <div class="col-md-6">
                        <br>
                            <h6><i class='fa fa-road'></i> Distance Covered By The Train</h6>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="distance" required value="<?php echo $data['distance']?>" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Km</span>
                            </div>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        <br>
                            <h6><i class='fa fa-subway'></i> Line</h6>
                            <select required name='line' class="form-control">
                                <option value="Main Line">Main Line</option>
                                <option value="Coastal Line">Coastal Line</option>
                                <option value="Northern Line">Northern Line</option>   
                                <option value="Eastern Line">Eastern Line</option>
                                <option value="Puttalam Line">Puttalam Line</option>
                                <option value="Kelani Valley Line">Kelani Valley Line</option> 
                                <option value="Intercity Express Services">Intercity Express Services [ICE] – Island wide</option>                    
                            </select>                               
                        </div>
                        <div class="col-md-6">
                        <br>
                            <h6><i class='fa fa-subway'></i> Frequency</h6>
                            <select required name='frequency' class="form-control">
                                <option value="Daily">Daily</option>
                                <option value="Weekend">Weekend</option>
                                <option value="Weekdays">Weekdays</option>                   
                            </select>                               
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <h6>Available Services:</h6>
                        <div class=" d-flex justify-content-between">
                            <ul class="list-group" >
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="A" <?php if($data['A']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>A</span>: Unreserved 2nd and 3rd Class
                                </li>
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="B" <?php if($data['B']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>B</span>: Restaurant / Buffet
                                </li>
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="C" <?php if($data['C']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>C</span>: Reserved 2nd Class
                                </li>
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="D" <?php if($data['D']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>D</span>: Reserved 2nd and 3rd Class Reclining Seat (Sleeperette)
                                </li>
                                <li class="list-group-item "  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="E" <?php if($data['E']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>E</span>: Reserved 1st Class Observation
                                </li>
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="F" <?php if($data['F']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>F</span>: Reserved 1st Class Sleeping Berth
                                </li>
                                <li class="list-group-item"  style="border: 0px;">
                                    <input type="checkbox" value='1' name ="G" <?php if($data['G']==1) echo 'checked'; ?>>&nbsp;&nbsp;
                                    <span translate='no'>G</span>: Reserved 1st class Air-conditioned coach
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6><i class='fa fa-subway'></i> Compartment Details</h6>
                        <div class="row">
                            <div class="input-group col-md-4">
                                <span class="input-group-text">No of 1<sup>st</sup>&nbsp;Class Compartments</span>
                                <input type="text" aria-label="First name" required class="form-control" value="<?php echo $data['firstClass']?>" name="first">
                            </div>
                            <div class="input-group col-md-4">
                                <span class="input-group-text">No of 2<sup>nd</sup>&nbsp;Class Compartments</span>
                                <input type="text" aria-label="First name" required class="form-control" value="<?php echo $data['second']?>" name="second">
                            </div>
                            <div class="input-group col-md-4">
                                <span class="input-group-text">No of 3<sup>rd</sup>&nbsp;Class Compartments</span>
                                <input type="text" aria-label="First name" required class="form-control" value="<?php echo $data['third']?>" name="third">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-success" input type="submit " name="submit" style="width: 250px;">Save Changes</button>                                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
require_once 'includes/footer.inc.php';
?>