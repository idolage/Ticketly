<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
$query = "SELECT COUNT(cNo), Ctype FROM complaints GROUP BY Ctype";
$result = mysqli_query($conn, $query);

$query2 = "SELECT COUNT(cNo), Ctype, userId, gender FROM complaints,users WHERE Ctype = 'H' GROUP BY gender";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT COUNT(token),Ttype FROM purchases GROUP BY Ttype";
$result3 = mysqli_query($conn, $query3);

$query4 = "SELECT COUNT(token),cityA FROM purchases GROUP BY cityA";
$result4 = mysqli_query($conn, $query4);

$query5 = "SELECT COUNT(token),cityB FROM purchases GROUP BY cityB";
$result5 = mysqli_query($conn, $query5);
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
</style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Type', 'Count'],
          <?php
            while ($row = mysqli_fetch_array($result)) {
                if($row["Ctype"] == 'R'){$Ctype = 'Regular';} else {$Ctype = 'Harassment';}
                echo "['" . $Ctype . "', " . $row["COUNT(cNo)"] . "],";
            }
            ?>
        ]);

        var options = {
          is3D: true,
          chartArea: {
                left: 10,
                top: 20
            },
            slices: {
                0: {color: '#1DE9B6'}, 
                1:{color: '#01579B'}
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Count'],
          <?php
            while ($row2 = mysqli_fetch_array($result2)) {
                if($row2["gender"] == 'F'){$gender = 'Female';} else if($row2["gender"] == 'M'){$gender = 'Male';} else if($row2["gender"] == 'O'){$gender = 'Other';}else {$gender = 'Not Mentioned';}
                echo "['" . $gender . "', " . $row2["COUNT(cNo)"] . "],";
            }
            ?>
        ]);

        var options = {
          is3D: true,
          chartArea: {
                left: 10,
                top: 20
            },
            slices: {
                0: {color: '#1DE9B6'}, 
                1:{color: '#2196F3'},
                2:{color: '#4527A0'}
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
</script>

<style>
    #chart_wrap {
    position: relative;
    padding-bottom: 25vh;
    height: 0;
    overflow:hidden;
    }   

    #chart_div {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height:100%;
    }
</style>
<script>
        $(window).on("throttledresize", function (event) {
        var options = {
        width: '100%',
        height: '100%'
        };

        var data = google.visualization.arrayToDataTable([]);
        drawChart(data, options);
        });
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Class', 'Count'],
            <?php
            while ($row3 = mysqli_fetch_array($result3)) {
                if($row3["Ttype"] == 'ac'){$Ttype = 'First';} else if($row3["Ttype"] == 'sc'){$Ttype = 'Second';} else {$Ttype = 'Third';}
                echo "['" . $Ttype . "', " . $row3["COUNT(token)"] . "],";
            }
            ?>
        ]);

        var options = {
          is3D: true,
          chartArea: {
                left: 10,
                top: 20
            },
          legend: { position: 'none' },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['City', 'Count'],
            <?php
            while ($row4 = mysqli_fetch_array($result4)) {
                echo "['" . $row4["cityA"] . "', " . $row4["COUNT(token)"] . "],";
            }
            ?>
        ]);

        var options = {
          is3D: true,
          chartArea: {
                left: 10,
                top: 20
            },
          legend: { position: 'none' },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div2'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['City', 'Count'],
            <?php
            while ($row5 = mysqli_fetch_array($result5)) {
                echo "['" . $row5["cityB"] . "', " . $row5["COUNT(token)"] . "],";
            }
            ?>
        ]);

        var options = {
          is3D: true,
          chartArea: {
                left: 10,
                top: 20
            },
          legend: { position: 'none' },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div3'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
</script>

<body onload=display_ct();>
<div class="card">
    <div class="text-right p-3 font-weight-bolder" style="font-size: 20px;">
        <span id='ct'></span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3 text-light text-center font-weight-bold">
                    <div class="card" style="background-color: #4DD0E1;">
                        <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Users</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(usersId) FROM users;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(usersId)'];
                        }
                        ?></h4>
                    </div>
                    <div class="card" style="background-color: #00BCD4;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of tickets purchased</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(token) FROM purchases;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(token)'];
                        }
                        ?></h4>
                    </div>
                    <div class="card" style="background-color: #0097A7;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Administrators</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(admisId) FROM admins;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(admisId)'];
                        }
                        ?></h4>
                    </div>
                    <div class="card" style="background-color: #26A69A;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Complaints</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(cNo) FROM complaints;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(cNo)'];
                        }
                        ?></h4>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3 text-light text-center font-weight-bold">
                    <div class="card shadow-lg" style="background-color: #7986CB;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Trains</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(trainNo) FROM trains;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(trainNo)'];
                        }
                        ?></h4>
                    </div>
                    <div class="card shadow-lg" style="background-color: #5C6BC0;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Stations</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(cityAb) FROM abbreviations;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(cityAb)'];
                        }
                        ?></h4>
                    </div>
                    <div class="card shadow-lg" style="background-color: #3F51B5;">
                    <br><h5 style="font-family: 'Dosis', sans-serif;"><strong>Total No of Trainlines</strong></h5>
                        <h4>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT lineType) FROM trains;";
                            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['COUNT(DISTINCT lineType)'];
                        }
                        ?></h4>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3">
                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Complaints Grouped by Type</span> 
                        </h5>
                        <div class="card-body">
                            <div id="chart_wrap">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Harassment Complaints Grouped by Gender</span> 
                        </h5>

                        <div class="card-body">
                            <div id="chart_wrap">
                                <div id="piechart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3">

                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Purchased Tickets Grouped by Class</span> 
                        </h5>
                        <div class="card-body">
                            <div id="chart_wrap">
                                <div id="top_x_div"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Purchased Tickets Grouped by Starting Station</span> 
                        </h5>

                        <div class="card-body">
                            <div id="chart_wrap">
                                <div id="top_x_div2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center">Purchased Tickets Grouped by Ending Station</span> 
                        </h5>

                        <div class="card-body">
                            <div id="chart_wrap">
                                <div id="top_x_div3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

    </div>
</div>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
var x1=x.toUTCString();// changing the display to UTC string
document.getElementById('ct').innerHTML = x1;
tt=display_c();
 }
</script>
<?php
require_once 'includes/footer.inc.php';
?>