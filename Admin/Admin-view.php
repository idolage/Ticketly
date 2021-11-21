<?php

if (isset($_GET['cNo'])) {

    $con = mysqli_connect("localhost", "root", "", "project_01");

    $cNo = ($_GET['cNo']);

    $name = "image";
    $type1 = "image";

    $query = "SELECT photo FROM complaints WHERE cNo= $cNo";
    $result = mysqli_query($con, $query) or die('Error, query failed');

    list($content) = mysqli_fetch_array($result);
    header("Content-Disposition: inline; filename=$name");
    ////header("Content-length: $size");
    header("Content-type: $type1");
    echo $content;

    exit;
}