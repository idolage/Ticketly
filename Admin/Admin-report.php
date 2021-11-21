<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
?>

<div class="card">
    <div class="card-header bg-primary text-light">
            <h6><strong>Generate Transaction Report</strong></h6>
    </div>
    <div class="card-body">
            <p class="h6 font-weight-bold">Please choose the date range</p>
            <div class="mb-5 col-md-8">

                <form class='form' method="post" action="Admin-dateReport.php">
                    <div class="form-group row">
                        <div class = 'col-md-4'>
                        <br>
                            <h6><i class='fa fa-calendar'></i> FROM</h6>
                            <input type="date" class="form-control" name="start_date"  required>                                
                        </div>
                        <div class="col-md-4">
                        <br>
                            <h6><i class='fa fa-calendar'></i> TO</h6>
                            <input type="date" class="form-control" name="end_date"  required>                                
                        </div>
                        <div class="col-md-4 text-center">
                        <br><br>
                            <button class="btn btn-success" input type="submit " name="export" value="Export as PDF" style=" width: 250px; height:45px;">Generate PDF</button>                               
                        </div>
                    </div>
                </form>

            </div>

            
            <div class="mb-5 col-md-8">
            <p class="h6 font-weight-bold">Please choose User ID</p>
                <form class='form' method="post" action="Admin-uidReport.php">
                    <div class="form-group row">
                        <div class = 'col-md-4'>
                        <br>
                            <h6><i class='fa fa-user'></i> USER ID</h6>
                            <input type="text" class="form-control" name="tuid"  required>                                
                        </div>
                        <div class="col-md-4 text-center">
                        <br><br>
                            <button class="btn btn-success" input type="submit " name="exportA" value="Export as PDF" style=" width: 250px; height:45px;">Generate PDF</button>                               
                        </div>
                    </div>
                </form>
            </div>

            <div class="mb-5 col-md-8">
            <p class="h6 font-weight-bold">Please choose class type</p>
                <form class='form' method="post" action="Admin-classReport.php">
                    <div class="form-group row">
                        <div class = 'col-md-4'>
                        <br>
                            <h6><i class='fa fa-train'></i> CLASS</h6>
                            <select required name='Ttype' class="form-control">
                                <option value="ac" translate='no'>First Class</option>
                                <option value="sc" translate='no'>Second Class</option>
                                <option value="tc" translate='no'>Third Class</option>                    
                            </select>                                
                        </div>
                        <div class="col-md-4 text-center">
                        <br><br>
                            <button class="btn btn-success" input type="submit " name="exportB" value="Export as PDF" style=" width: 250px; height:45px;">Generate PDF</button>                              
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>