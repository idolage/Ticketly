<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Add New Train Route</strong></h6>
    </div>
    <div class="card-body">
        <p class='text-primary' style="font-size: 20px;">Fill in details</p>
        <?php 
        
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Fill in all fields!</strong>
                    </div>"; 
                }
                else if ($_GET["error"] == "invalidab") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Abbreviations should contain exactly three letters!</strong>
                    </div>";
                }
                else if ($_GET["error"] == "samelocation") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Both cities cannot be the same!</strong>
                    </div>";
                }
                else if ($_GET["error"] == "sameab") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Both abbreviations cannot be the same!</strong>
                    </div>"; 
                }  
                else if ($_GET["error"] == "stmtfailed") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Oops! Something went wrong, Please try again!</strong>
                    </div>";
                }  
                else if ($_GET["error"] == "differentAbA") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Location A already exists in the database! Please use the same abbreviation!</strong>
                    </div>";
                } 
                else if ($_GET["error"] == "differentAbB") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Location B already exists in the database! Please use the same abbreviation</strong>
                    </div>";
                }
                else if ($_GET["error"] == "abtakenA") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Abbreviation used for location A already exists in the database for a different location. Please use a different abbreviation</strong>
                    </div>";
                }
                else if ($_GET["error"] == "abtakenB") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Abbreviation used for location B already exists in the database for a different location. Please use a different abbreviation</strong>
                    </div>";
                }
                else if ($_GET["error"] == "trainexist") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Train-route already entered!</strong>
                    </div>";
                }  
                else if ($_GET["error"] == "invalidamount") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Invalid ticket price!</strong>
                    </div>";
                }           
                else if ($_GET["error"] == "none") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>You have successfully entered the details!</strong>
                    </div>";
                }
            }
        ?>
        <form class="form" action="includes/addTrainRoute.inc.php" method="POST">
            <div class="form-group row">
                <label for="locationA" class="col-12 col-md-2 col-form-label"><h6><i class="fa fa-map-marker"></i> Location <span translate='no'>A</span></h6></label>
                <div class="col-12 col-md-8">
                    <input type="text" class="form-control" name="locationA" placeholder="Enter Location A">
                </div>
            </div>
            <div class="form-group row">
                <label for="locationB" class="col-12 col-md-2 col-form-label"><h6><i class="fa fa-map-marker"></i> Location <span translate='no'>B</span></h6></label>
                <div class="col-12 col-md-8">
                    <input type="text" class="form-control" name="locationB" placeholder="Enter Location B">
                </div>
            </div>
            <div class="form-group row">
                <label for="locationAshort" class="col-12 col-md-12 col-form-label"><strong>Choose abbreviations for both locations:</strong></label>
            </div>
            <div class="form-group row">
                <label for="locationAshort" class="col-12 col-md-2 col-form-label"><h6><i class="fa fa-map-marker"></i> Location <span translate='no'>A</span></h6></label>
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" name="locationAshort" placeholder="Enter Abbreviation For Location A">
                </div>
                <label for="locationBshort" class="col-12 col-md-2 col-form-label"><h6><i class="fa fa-map-marker"></i> Location <span translate='no'>B</span></h6></label>
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" name="locationBshort" placeholder="Enter Abbreviation For Location B">
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-12 col-md-2 col-form-label"><h6 translate='no'><i class="fa fa-train"></i> Type</h6></label>
                <div class="col-12 col-md-3 ">
                    <select required name='type' class="form-control">
                        <option value="ac" translate='no'>First Class Intercity</option>
                        <option value="sc" translate='no'>Second Class Intercity</option>
                        <option value="tc" translate='no'>Third Class Intercity</option>                    
                    </select> 
                </div>
            </div>
            <div class="form-group row">
                <label for="Price" class="col-12 col-md-2 col-form-label"><h6><i class="fa fa-money"></i> Price</h6></label>
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" name="price" placeholder="Price">
                </div>
            </div>
            <br>
            <div class="form-group row justify-content-center">
                <button class="btn btn-success" input type="submit " name="submit" style="width: 250px;">Add Train Route</button>                                
            </div>
        </form>

            <h6><strong>Search Abbreviations</strong></h6>
            <form class="d-flex" action="includes/searchAbbreviations.inc.php" method="POST">
                <div class="input-group">
                    <button class="btn btn-secondary text-light" disabled ><i class="fa fa-search fa-lg"></i></button>
                    <input type="text" name="location" class="form-control col-lg-4" placeholder="Search By Location...">
                    <button class="btn btn-outline-primary" type="submit" name="submit">Search</button>
                </div>
            </form>
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "Noresults") {
                        echo "<div class= 'alert alert-info col-lg-6'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>No matched results! Please create a new abbreviation</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "results") {
                        echo "<div class= 'alert alert-info col-lg-6'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Abbreviation for ".$_GET['location']." is ".$_GET['AbName']."</strong>
                        </div>";
                    }
                }
            ?>
    </div>
</div>
<!--Error modal start-->
<div class="modal fade" id="ErrorModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-light">Oops! Looks like something went wrong</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo $msg ?>
            </div>
        </div>
    </div>
</div>
<!--Error modal start end-->

<!--Success modal start-->
<div class="modal fade" id="SuccessModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">OTP Successfully Generated</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo $msg ?>
            </div>
        </div>
    </div>
</div>
<!--Success modal end-->
<?php
require_once 'includes/footer.inc.php';
?>