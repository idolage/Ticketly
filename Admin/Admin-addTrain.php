<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Add New Train</strong></h6>
    </div>
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
                    <strong>Train Successfully Added To The Database!</strong>
                    </div>"; 
                }
            }
    ?>
        <form class='form' method="POST" action='includes/addTrain.inc.php'> 
            <div class="form-group row">
                <div class = 'col-md-6'>
                <br>
                    <h6><i class='fa fa-train'></i> Train No</h6>
                    <input type="text" class="form-control" name="tNo" placeholder="Enter Train No" required>                                
                </div>
                <div class="col-md-6">
                <br>
                    <h6><i class='fa fa-train'></i> Train Name</h6>
                    <input type="text" class="form-control" name="tName" placeholder="Enter Train Name" required>                                
                </div>
            </div>
            <div class="form-group row">
                <div class = 'col-md-6'>
                    <br>
                    <h6><i class='fa fa-map-marker'></i> Starting Station</h6>
                    <input type="text" class="form-control" name="start" placeholder="Enter Starting Station" required>                                
                </div>
                <div class="col-md-6">
                    <br>
                    <h6><i class='fa fa-map-marker'></i> Ending Station</h6>
                    <input type="text" class="form-control" name="end" placeholder="Enter Ending Station" required>                                
                </div>
            </div>
            <div class="form-group row">
                <div class = 'col-md-6'>
                <br>
                    <h6><i class='fa fa-map-signs'></i> No of Stops</h6>
                    <input type="text" class="form-control" name="stops" placeholder="Enter Total No of Stops" required>                                
                </div>
                <div class="col-md-6">
                <br>
                    <h6><i class='fa fa-road'></i> Distance Covered By The Train</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="distance" required placeholder="Enter Distance in Kilometers" aria-describedby="basic-addon2">
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
                        <option value="Intercity Express Services">Intercity Express Services <span translate='no'>[ICE]</span> – Island wide</option>                    
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
                            <input type="checkbox" value='1' name ="A">&nbsp;&nbsp;
                            <span translate='no'>A</span>: Unreserved 2nd and 3rd Class
                        </li>
                        <li class="list-group-item"  style="border: 0px;">
                            <input type="checkbox" value='1' name ="B">&nbsp;&nbsp;
                            <span translate='no'>B</span>: Restaurant / Buffet
                        </li>
                        <li class="list-group-item"  style="border: 0px;">
                            <input type="checkbox" value='1' name ="C">&nbsp;&nbsp;
                            <span translate='no'>C</span>: Reserved 2nd Class
                        </li>
                        <li class="list-group-item"  style="border: 0px;">
                            <input type="checkbox" value='1' name ="D">&nbsp;&nbsp;
                            <span translate='no'>D</span>: Reserved 2nd and 3rd Class Reclining Seat (Sleeperette)
                        </li>
                        <li class="list-group-item "  style="border: 0px;">
                            <input type="checkbox" value='1' name ="E">&nbsp;&nbsp;
                            <span translate='no'>E</span>: Reserved 1st Class Observation
                        </li>
                        <li class="list-group-item"  style="border: 0px;">
                            <input type="checkbox" value='1' name ="F">&nbsp;&nbsp;
                            <span translate='no'>F</span>: Reserved 1st Class Sleeping Berth
                        </li>
                        <li class="list-group-item"  style="border: 0px;">
                            <input type="checkbox" value='1' name ="G">&nbsp;&nbsp;
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
                        <input type="text" aria-label="First name" required class="form-control" name="first">
                    </div>
                    <div class="input-group col-md-4">
                        <span class="input-group-text">No of 2<sup>nd</sup>&nbsp;Class Compartments</span>
                        <input type="text" aria-label="First name" required class="form-control" name="second">
                    </div>
                    <div class="input-group col-md-4">
                        <span class="input-group-text">No of 3<sup>rd</sup>&nbsp;Class Compartments</span>
                        <input type="text" aria-label="First name" required class="form-control" name="third">
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row justify-content-center">
                <button class="btn btn-success" input type="submit " name="submit" style="width: 250px;">Add Train</button>                                
            </div>
        </form>
    </div>
</div>
<br>
<?php
require_once 'includes/footer.inc.php';
?>