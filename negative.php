<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Help</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./signup.css">
</head>

<?php
    $con=mysqli_connect('localhost','root','','covid') or die(mysql_error());
    if (!$con) {
        echo "Connect failed: %s\n".mysqli_connect_error();
        exit();
    }
    $user=$_GET['usrnm'];
    $loc=mysqli_query($con,"select location from signup where usrnm='$user';");
    $dloc="";
    while($cloc=mysqli_fetch_array($loc)){$dloc=$cloc['location'];}
    $location=mysqli_query($con,"select count(usrnm) from signup where status='positive' and location='$dloc';");
?>


<body>
    <div class="log">
        <h1 id="heads"><span>!! Welcome to CORONA SUPPORT !!</span></h1>
        <p id="most">
        <h3>Most common symptoms:</h3>
        <ol>
            <li>fever</li>
            <li>dry cough</li>
            <li>tiredness</li>
        </ol>            
        </p>
        <h3 style="color: red;"><?php while($r=mysqli_fetch_array($location)){echo $r['count(usrnm)'];}?> cases of corona in your locality</h3>
        <h2>Stay Home! Stay Safe!</h2>
        <h2>.......Get well soon......</h2>
        <a href="./assets/covid-test-centres.jpg" class="btn btn-primary btn-lg" role="button">SEEK HELP</a>
        <a href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019/technical-guidance/health-workers" class="btn btn-primary btn-lg" role="button">KNOW MORE</a>
        <a href=" https://www.healthline.com/health/coronavirus-covid-19#symptoms" class="btn btn-primary btn-lg" role="button">SYMPTOMS</a>
        <a href=" https://www.denverhealth.org/news/2020/05/how-to-self-quarantine-when-living-in-a-small-apartment-or-home-with-other-people" class="btn btn-primary btn-lg" role="button">QUARANTINE</a>
        <a href="./signup.php"><p id="new" style="font-size: 22px; text-decoration:underline"><b>LOGOUT</b></p></a>

</body>
</html>