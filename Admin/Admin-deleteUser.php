<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="col d-flex justify-content-center">
    <div class="card border-primary mb-3 " style="min-width: 50vw">
        <div class="card-header bg-primary text-light text-center"><h5>Delete User</h5></div>
        <div class="card-body">
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "none") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>User has been deleted successfully!</strong>
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
            <form class="d-flex" action="includes/searchByID.inc.php" method="POST">
                <div class="input-group">
                    <button class="btn btn-secondary text-light" disabled ><i class="fa fa-trash fa-lg"></i></button>
                    <input type="text" name="uid" class="form-control" placeholder="Delete By User ID...">
                    <button class="btn btn-outline-danger" type="submit" name="submitID">Delete</button>
                </div>
            </form>
            <form class="d-flex" action="includes/searchByUsername.inc.php" method="POST">
                <div class="input-group">
                    <button class="btn btn-secondary text-light" disabled ><i class="fa fa-trash fa-lg"></i></button>
                    <input type="text" name="uname" class="form-control" placeholder="Delete By Username...">
                    <button class="btn btn-outline-danger" type="submit" name="submitName">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>