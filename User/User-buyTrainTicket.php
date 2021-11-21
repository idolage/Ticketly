<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$result = mysqli_query($conn,"SELECT * FROM abbreviations");
$result_A = mysqli_query($conn,"SELECT * FROM abbreviations");
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Buy Train Ticket</strong></h6>
    </div>
    
    <div class="card-body">
        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "Samecity") {
                    echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Choose different cities!</strong>
                        </div>"; 
                }
                else if ($_GET["error"] == "noTrain") {
                    
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - No train is available through that route!</strong>
                    </div>";
                }
                else if ($_GET["error"] == "stmtfailed") {
                    
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Cannot Connect To The Database!</strong>
                    </div>";
                }
                else if ($_GET["error"] == "exceed") {
                    
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error - Tickets Sold Out!</strong>
                    </div>";
                }
                else if ($_GET["error"] == "paid") {
                    
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>You have successfully purchased your ticket(s). Check your email for further details</strong>
                    </div>";
                }
            }
        ?>
        <form action="includes/checkTicketAvailability.inc.php" method="post">

            <div class="form-group row">
                <div class = 'col-md-6'>
                    <br>
                    <h6><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<strong>From</strong></h6>
                    <select required name='from' placeholder= 'from' type='varchar'class="form-control">
                        <?php
                            if ($result) {                                        
                                while ($row=mysqli_fetch_array($result)) {
                                    $city = $row["cityName"];
                                    echo"<option value=$city>$city<br></option>";
                                }
                            }
                        ?>
                    </select>                               
                </div>
                <div class="col-md-6">
                    <br>
                    <h6><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<strong>To</strong></h6>
                    <select required name='to' placeholder= 'to' type='text'class="form-control">
                        <?php
                            if ($result_A) {                                    
                                while ($row=mysqli_fetch_array($result_A)) {
                                    $city = $row["cityName"];
                                    echo"<option value=$city>$city<br></option>";
                                }
                            }
                        ?>
                    </select>                               
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class = 'col-md-6'>
                    <br>
                    <h6><i class="fa fa-train"></i>&nbsp;&nbsp;&nbsp;<strong>Train Type</strong></h6>
                    <select required name='type'placeholder='type'class="form-control">
                        <option value="ac">First Class</option>
                        <option value="sc">Second Class</option>
                        <option value="tc">Third Class</option>
                    </select>
                </div>
                <div class = 'col-md-6'>
                    <br>
                    <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;<strong>Travel Date</strong></h6>
                    <input type="date" id="dt" class="form-control" name="dt" required>
                </div>
            </div>
            <br>
            <div class="form-group row justify-content-center">
                <button class="btn btn-primary" input type="submit " name="submit">Check Availability</button>                                
            </div>

        </form>   
        
    </div>
</div>


<?php
require_once 'includes/footer.inc.php';
?>