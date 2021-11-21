<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$id = $_SESSION["userid"];
$result = mysqli_query($conn,"SELECT * FROM trains");
$result_A = mysqli_query($conn,"SELECT * FROM trains");
?>
<link href="../User/StudyUpload.css" rel="stylesheet">
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
                        <strong>Complaint Successfully Submitted! You will receive an email from us after the complaint is reviewed</strong>
                        </div>"; 
                }
            }
        ?>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <p class='text-primary' style="font-size: 20px;">File New Complaint</p>
        </button>
        <div id="collapseOne" class="collapse">
            <p class="text-dark" style="font-size: 14px;"><strong>Please note that regular complaints are always visible to other users</strong></p>
            <div class="card-body">
                <form class="uploader" action="includes/complaint.inc.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <h6><strong>Select Train</strong></h6>
                        <select required name='trainNo' type='text'class="form-control">
                            <?php
                                if ($result) {                                        
                                    while ($row=mysqli_fetch_array($result)) {
                                        $trainNo = $row["trainNo"];
                                        $trainName = $row["trainName"];
                                        echo"<option value=$trainNo>$trainNo - $trainName<br></option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group row">
                        <h6 ><strong translate="no">Type</strong></h6>
                        <select required name='Ctype'placeholder='type'class="form-control">
                        <option value="R">Regular Complaint</option>
                        <option value="H">Harassment Complaint</option>
                    </select>
                    </div> 

                    <div class="form-group row">
                        <h6 ><strong>Description</strong></h6>
                        <textarea class="form-control" name="detail" required></textarea> 
                    </div> 

                    <div class="form-group row">
                    <label for="file-upload" class="outer">
                        <img id="file-image" src="#" alt="Preview" class="hidden">
                        
                        <div id="start">
                            <label for ="select">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div>Upload a photo if available</div>
                            </label>
                            <input type='file' id="select" style="display:none" name="file">
                        </div>

                        <div>
                            <p id="chosenfile"></p>
                        </div>

                    </label>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button class="btn btn-primary" input type="submit " name="btn-upload" style="width: 250px;">File Complaint</button>                                
                    </div>
                </form>

            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <p class='text-primary' style="font-size: 20px;">Complaint History</p>
        </button>
        <div id="collapseTwo" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Train No</th>
                        <th>Complaint Type</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Submitted Time & Date</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php    
                            $sql = "SELECT * FROM complaints WHERE userId = $id;";
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['trainNo']."</td>
                                                    <td>"?><?php if($row['Ctype']=='R'){echo"Regular</td>";} else if($row['Ctype']=='H'){echo"Harassment</td>";}?>
                                    <?php echo"
                                                    <td>".$row['detail']."</td>
                                                    <td>"?><?php if($row['photo']==NULL){echo"</td>";} else { $cNo = $row['cNo']; echo"<a href='User-view.php?cNo=$cNo; &type=image'><i class='text-primary'>View</i></a></td>";}?>
                                    <?php echo"
                                                    <td>".$row['DT']."</td>
                                                    <td>"?><?php if($row['adminsID']==NULL){echo"<i>Yet to be reviewed</i></td>";} else { echo $row['adminsID']."</td>";}?>
                                    <?php echo"
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
        <p class='text-primary' style="font-size: 20px;">Regular Complaints From Other Users </p>
        </button>
        <div id="collapseThree" class="collapse">
        <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Train No</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Submitted Time & Date</th>
                    </thead>
                    <tbody>
                        <?php    
                            $sql = "SELECT * FROM complaints WHERE userId != $id AND Ctype = 'R';";
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['trainNo']."</td>
                                                    <td>".$row['detail']."</td>
                                                    <td>"?><?php if($row['photo']==NULL){echo"</td>";} else { $cNo = $row['cNo']; echo"<a href='User-view.php?cNo=$cNo; &type=image'>View</a></td>";}?>
                                    <?php echo"
                                                    <td>".$row['DT']."</td>
                                                </tr>
                                        ";
                                    }

                            if ($i == 0)
                            {echo "<tr><td colspan='5' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";}
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  var input = document.getElementById('select');
  var infoArea = document.getElementById('chosenfile');
  input.addEventListener('change',showFileName);

  function showFileName(event){
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'Selected File: ' + fileName;
  }
</script>

<?php
require_once 'includes/footer.inc.php';
?>