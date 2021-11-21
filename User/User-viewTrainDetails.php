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
                    <td>A</td>
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
                    <td>B</td>
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
                    <td>C</td>
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
                    <td>D</td>
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
                    <td>E</td>
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
                    <td>F</td>
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
                    <td>G</td>
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
            </div>
        </div>
    </div>
  </div>
</div>    
</div>

<?php
}
require_once 'includes/footer.inc.php';
?>