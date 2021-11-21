<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Check Train-Routes Details</strong></h6>
    </div>
    
    <div class="card-body">
    
        <P class="text-dark"><strong>Click on the links to view further details</strong></P>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        <p class='text-primary' style="font-size: 20px;">AC Intercity Train Fares Per Seat - (First Class)</p>
        </button>
        <div id="collapseOne" class="collapse">
            <div class="card-body table-responsive table-sm table-hover">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Location A</th>
                            <th scope="col">Location B</th>
                            <th scope="col">Fare Per Seat (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT abbreviations.cityName, price.cityA, price.cityB, price.price FROM price,abbreviations WHERE price.Ttype ='ac' AND abbreviations.cityAb = price.cityA;";
                            
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;
                                    echo "  <tr>
                                                <td>".$i."</td>
                                                <td>".$row['cityA']."  -  ".$row['cityName']."</td>
                                                <td>".$row['cityB']."  -  ";
                                                $city = $row['cityB'];
                                                $sql2 = "SELECT cityName FROM abbreviations WHERE cityAb= '$city';";
                                                $result2 = mysqli_query($conn, $sql2) or die( mysqli_error($conn));
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2['cityName']."</td>";}
                                                
                                                echo "<td>".$row['price'].".00</td>
                                            </tr>
                                    ";
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <p class='text-primary' style="font-size: 20px;">SC Intercity Train Fares Per Seat - (Second Class)</p>
        </button>
        <div id="collapseTwo" class="collapse">
            <div class="card-body table-responsive table-sm table-hover">
            <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Location A</th>
                            <th scope="col">Location B</th>
                            <th scope="col">Fare Per Seat (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT abbreviations.cityName, price.cityA, price.cityB, price.price FROM price,abbreviations WHERE price.Ttype ='sc' AND abbreviations.cityAb = price.cityA;";
                            
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;
                                    echo "  <tr>
                                                <td>".$i."</td>
                                                <td>".$row['cityA']."  -  ".$row['cityName']."</td>
                                                <td>".$row['cityB']."  -  ";
                                                $city = $row['cityB'];
                                                $sql2 = "SELECT cityName FROM abbreviations WHERE cityAb= '$city';";
                                                $result2 = mysqli_query($conn, $sql2) or die( mysqli_error($conn));
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2['cityName']."</td>";}
                                                
                                                echo "<td>".$row['price'].".00</td>
                                            </tr>
                                    ";
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <p class='text-primary' style="font-size: 20px;">TC Intercity Train Fares Per Seat - (Third Class)</p>
        </button>
        <div id="collapseThree" class="collapse">
            <div class="card-body table-responsive table-sm table-hover">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Location A</th>
                            <th scope="col">Location B</th>
                            <th scope="col">Fare Per Seat (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT abbreviations.cityName, price.cityA, price.cityB, price.price FROM price,abbreviations WHERE price.Ttype ='tc' AND abbreviations.cityAb = price.cityA;";
                            
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;
                                    echo "  <tr>
                                                <td>".$i."</td>
                                                <td>".$row['cityA']."  -  ".$row['cityName']."</td>
                                                <td>".$row['cityB']."  -  ";
                                                $city = $row['cityB'];
                                                $sql2 = "SELECT cityName FROM abbreviations WHERE cityAb= '$city';";
                                                $result2 = mysqli_query($conn, $sql2) or die( mysqli_error($conn));
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2['cityName']."</td>";}
                                                
                                                echo "<td>".$row['price'].".00</td>
                                            </tr>
                                    ";
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        <p class='text-primary' style="font-size: 20px;">Check Cities & Abbrevations In Use</p>
        </button>
        <div id="flush-collapseFour" class="collapse">
            <div class="card-body table-responsive table-sm table-hover">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Location</th>
                            <th scope="col">Abbrevation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM abbreviations ORDER BY cityName ASC;";
                            $i = 0;
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;
                                echo "  <tr>
                                            <td>".$i."</td>
                                            <td>".$row['cityName']."</td>
                                            <td>".$row['cityAb']."</td>
                                        </tr>";
                            }
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
