<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Ticket Details</strong></h6>
    </div>
    <div class="card-body my-auto mx-auto">
        <form class="shadow-lg p-3" action="User-payPortal.php" method="post">
            <img src="..\Admin\AdminLogin\images\img-01.png" alt="IMG">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>From</td>
                        <td>:</td>
                        <td><?php echo $_SESSION['from'] ?></td>
                    </tr>
                    <tr>
                        <td>To</td>
                        <td>:</td>
                        <td><?php echo $_SESSION['to'] ?></td>
                    </tr>
                    <tr>
                        <td>Date of Travel</td>
                        <td>:</td>
                        <td><?php echo $_SESSION['dt'] ?></td>
                    </tr>
                    <tr>
                        <td>Type of ticket</td>
                        <td>:</td>
                        <td> <?php 
                                if ($_SESSION['type']=='ac'){
                                    echo "First Class";
                                }
                                elseif ($_SESSION['type']=='sc') {
                                    echo "Second Class";
                                }
                                elseif ($_SESSION['type']=='tc') {
                                    echo "Third Class";
                                }
                            ?></td>
                    </tr>
                    <tr>
                        <td>Price per ticket</td>
                        <td>:</td>
                        <td>LKR <?php echo $_SESSION['price'] ?>.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group row justify-content-center">
                <button class="btn btn-primary" input type="submit " name="submit">Purchase</button>                                
            </div>
        </form>
    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>