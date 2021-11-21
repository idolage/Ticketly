<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
            <h6><strong>Complaints</strong></h6>
    </div>
    <div class="card-body">
        <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "none") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Feedback is submitted successfully!</strong>
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
    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <p class='text-primary' style="font-size: 20px;">Regular Complaints</p>
        </button>
        <div id="collapseTwo" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Complainer</th>
                        <th>Reviewer</th>
                        <th>Train No</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Submitted Time & Date</th>
                    </thead>
                    <tbody>
                    <?php    
                            $sql = "SELECT * FROM complaints, users WHERE complaints.userId = users.usersId AND complaints.Ctype = 'R';";

                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['usersName']."</td>
                                                    <td>"?><?php if($row['adminsID']==NULL){$cNo = $row['cNo']; $usersName = $row['usersName']; $usersEmail = $row['usersEmail']; echo"<a href='Admin-review.php?cNo=$cNo&usersName=$usersName&usersEmail=$usersEmail'><i class='text-primary'>Yet to be reviewed</i></a></td>";} else { echo $row['adminsName']."<br>Admin's ID - ".$row['adminsID']."</td>";}?>
                                        <?php echo" <td>".$row['trainNo']."</td>
                                                    <td>".$row['detail']."</td>
                                                    <td>"?><?php if($row['photo']==NULL){echo"</td>";} else { $cNo = $row['cNo']; echo"<a href='Admin-view.php?cNo=$cNo; &type=image'><i class='text-primary'>View</i></a></td>";}?>
                                        <?php echo" <td>".$row['DT']."</td>
                                        </tr>
                                        ";
                                    }

                            if ($i == 0)
                            {echo "<tr><td colspan='7' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";}
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <p class='text-primary' style="font-size: 20px;">Harassment Complaints</p>
        </button>
        <div id="collapseThree" class="collapse">
        <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Complainer</th>
                        <th>Reviewer</th>
                        <th>Train No</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Submitted Time & Date</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php    
                            $sql = "SELECT * FROM complaints, users WHERE complaints.userId = users.usersId AND complaints.Ctype = 'H';";

                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['usersName']."</td>
                                                    <td>"?><?php if($row['adminsID']==NULL){$cNo = $row['cNo']; $usersName = $row['usersName']; $usersEmail = $row['usersEmail']; echo"<a href='Admin-review.php?cNo=$cNo&usersName=$usersName&usersEmail=$usersEmail'><i class='text-primary'>Yet to be reviewed</i></a></td>";} else { echo $row['adminsName']."<br>Admin's ID - ".$row['adminsID']."</td>";}?>
                                        <?php echo" <td>".$row['trainNo']."</td>
                                                    <td>".$row['detail']."</td>
                                                    <td>"?><?php if($row['photo']==NULL){echo"</td>";} else { $cNo = $row['cNo']; echo"<a href='Admin-view.php?cNo=$cNo; &type=image'><i class='text-primary'>View</i></a></td>";}?>
                                        <?php echo" <td>".$row['DT']."</td>
                                                    <td>"?><?php if($row['adminsID']==NULL){} else {$cNo = $row['cNo']; echo"<a href='Admin-download.php?cNo=$cNo'><i class='text-primary'>Download</i></a></td>";}?>
                                        <?php echo"  
                                                </tr>
                                        ";
                                    }

                            if ($i == 0)
                            {echo "<tr><td colspan='8' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";}
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.inc.php';
?>