<!DOCTYPE html>
<html>
<head>
    <title>Doctor</title>
    <link rel="stylesheet" href="../css/stylesDoctor.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap"
          rel="stylesheet">
</head>
<header>
    <h1>Doctor<span>Patient</span></h1>
    <nav>
        <ul>
            <li><a href="index.php">My Info</a></li>
            <li><a href="appointments.php">My Appointments</a></li>
            <li><a href="searchPatient.php">Search Patient</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<form method="post" action="searchPatient.php" class="patientsearch">

    <div class="input-group">
        <label style="font-weight: bold; font-size: 30px">Search Patient by:</label>
        <label style="font-weight: bold">Name/Email</label>
        <input type="text" name="PID">
    </div>

    <div class="input-group">
        <button type="submit" name="SearchP" class="btn">Search</button>
    </div>
</form>
</form>

<?php

if (isset($_POST['SearchP'])) {

?>
<table class="table3">
    <caption style="margin-left: 34px;padding: 10px;font-weight: bold;font-size: 30px;" class="asd">Patient Information</caption>
    <tr>
        <th>PatientID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $PID = $mysqli->real_escape_string($_POST['PID']);
    $sqlP = "SELECT * FROM patient WHERE PatientName=('$PID') or Email=('$PID')";
    $resultP = $mysqli->query($sqlP);
    if (mysqli_num_rows($resultP) == 1) {
        while ($rowP = $resultP->fetch_assoc()) {
            echo "<tr><td>" . $rowP["PatientID"] . "</td><td>" . $rowP["PatientName"] . "</td><td>" . $rowP["Email"] . "</td><td>" . $rowP['Address'] . "</td><td>" . $rowP["ContactNumber"] . "</td></tr>";
        }
        echo "</table";
    }
    }
?>
</table>


</table>
</body>
</html>


