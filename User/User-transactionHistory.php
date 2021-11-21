<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$id = $_SESSION['userid'];
?>
<div class="card" style="min-height: 80vh;">
    <div class="card-header bg-primary text-light">
        <h6><strong>Transaction History</strong></h6>
    </div>
    
    <div class="card-body table-responsive table-hover">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>To</th>
                    <th>From</th>
                    <th>Ticket<span translate="no"> Ref. No</span></th>
                    <th>Token</th>
                    <th>Date of Travel</th>
                    <th>Paid Amount</th>
                    <th>Purchased At</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM purchases WHERE userID = $id;";
                    $i = 0;
                    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".$row['cityA']."</td>
                                <td>".$row['cityB']."</td>
                                <td>".$row['ticketNo']."</td>
                                <td>".$row['token']."</td>
                                <td>".$row['DT']."</td>
                                <td>".$row['amount']."</td>
                                <td>".$row['purchasedAt']."</td>
                            </tr>
                        ";
                    }
                    if ($i == 0)
                    {
                        echo "<tr><td colspan='8' class='text-center'><strong><i>No Records To Show!</i></strong></td></tr>";
                    }
                ?>
            </tbody>

        </table>
    </div>

</div>

<?php
require_once 'includes/footer.inc.php';
?>