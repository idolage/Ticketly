<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
$_SESSION['cNo'] = $_GET['cNo']; 
$_SESSION['usersName'] = $_GET['usersName']; 
$_SESSION['usersEmail'] = $_GET['usersEmail'];

?>

<div class="col d-flex justify-content-center">
    <div class="card border-primary mb-3 " style="min-width: 50vw">
        <div class="card-header bg-primary text-light text-center"><h5>Review Complaint</h5></div>
        <div class="card-body">
            <h6><strong>Write feedback to the complainer</strong></h6><br>
            
            <form class='form' method="POST" action="includes/review.inc.php">
                <div class="form-group row">
                    <div class="col-md-6">
                        <h6>Complaint No</h6>
                        <input type="text" class="form-control" name="cNo" placeholder="<?php echo $_SESSION['cNo']?>" disabled>                                
                    </div>
                    <div class = 'col-md-6'>
                        <h6>Complainer's Name</h6>
                        <input type="text" class="form-control" name="usersName" placeholder="<?php echo $_SESSION['usersName']?>" disabled>                                
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <h6>Email Address</h6>
                    <input type="email" class="form-control" name="usersEmail" placeholder="<?php echo $_SESSION['usersEmail']?>" disabled>
                </div>
                <br>
                <div class="form-group row">
                    <h6 ><strong>Feedback</strong></h6>
                    <textarea class="form-control" name="feedback" required></textarea> 
                </div> 
                <br>
                <div class="form-group row justify-content-center">
                        <button class="btn btn-primary" input type="submit " name="btn-upload" style="width: 250px;">Email Review</button>                                
                </div>
            </form>           
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.inc.php';
?>