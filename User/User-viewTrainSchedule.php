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
                    if ($_GET["error"] == "stmtfailed") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error - Cannot connect to the database!</strong>
                        </div>"; 
                    }
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
                            echo "<tr><td colspan='4' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
</div>

<?php
require_once 'includes/footer.inc.php';
?>