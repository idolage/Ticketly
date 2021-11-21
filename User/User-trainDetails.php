<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Check Train Details</strong></h6>
    </div>
    <div class="card-body">
        <P class="text-dark"><strong>Click on the links to view further details about trains under each line</strong></P>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        <p class='text-primary' style="font-size: 20px;">Main Line</p>
        </button>
        <div id="collapseOne" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity, endCity FROM trains WHERE lineType = 'Main Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){ 
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>" title="View Details" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <p class='text-primary' style="font-size: 20px;">Intercity Express Services [ICE] – Island wide</p>
        </button>
        <div id="collapseTwo" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity, endCity  FROM trains WHERE lineType = 'Intercity Express Services' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Details" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <p class='text-primary' style="font-size: 20px;">Coastal Line</p>
        </button>
        <div id="collapseThree" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity, endCity  FROM trains WHERE lineType = 'Coastal Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Schedule" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;"> 
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        <p class='text-primary' style="font-size: 20px;">Northern Line</p>
        </button>
        <div id="flush-collapseFour" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity, endCity  FROM trains WHERE lineType = 'Northern Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Schedule" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
        <p class='text-primary' style="font-size: 20px;">Eastern Line</p>
        </button>
        <div id="flush-collapseFive" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity , endCity  FROM trains WHERE lineType = 'Eastern Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Schedule" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
        <p class='text-primary' style="font-size: 20px;">Puttalam Line</p>
        </button>
        <div id="flush-collapseSix" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity , endCity  FROM trains WHERE lineType = 'Puttalam Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Schedule" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
        <p class='text-primary' style="font-size: 20px;">Kelani Valley Line</p>
        </button>
        <div id="flush-collapseSeven" class="collapse">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 14px; color:black;">
                    <?php
                        $records = mysqli_query($conn,"SELECT trainNo, trainName, lineType, startCity , endCity  FROM trains WHERE lineType = 'Kelani Valley Line' ORDER BY trainNo ASC");
                         while($data=mysqli_fetch_array($records)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $data['trainNo'];?>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <?php echo $data['trainName'];?>
                        </td>
                        <td>
                            From <?php echo $data['startCity'];?> to <?php echo $data['endCity'];?>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainDetails.php?trainNo=<?php echo $data['trainNo']?>&line=<?php echo $data['lineType']?>" title="View Schedule" class="text-primary infoBtn"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;View Details</a>
                        </td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="User-viewTrainSchedule.php?trainNo=<?php echo $data['trainNo']?>&trainName=<?php echo $data['trainName']?>" title="View Schedule" class="text-info infoBtn"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;&nbsp;View Schedule</a>
                        </td>
                    </tr>
                    <?php
                        }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>