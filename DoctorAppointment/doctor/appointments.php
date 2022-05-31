<!DOCTYPE html>
<html>
<head>
    <title>Doctor</title>
    <link rel="stylesheet"  href="../css/stylesDoctor.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
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
<!--<h1 class="my1">My<span class="mys">Appointments</span></h1>-->
<form method="post" action="appointments.php" class="patientsearch">
    <div class="input-group">
        <label style="font-weight: bold; font-size: 30px">Doctor Name:</label>
        <input type="text" name="docName" placeholder="Enter Your Name" required>
    </div>

    <div class="input-group">
        <button type="submit" name="Search" class="btn">Search</button>
    </div>
</form>
<?php
if (isset($_POST['Search'])) {
?>
<table class="table3">
    <caption style="margin-left: 34px;padding: 10px;font-weight: bold;font-size: 30px;" class="asd">Appointments
    </caption>
    <tr>
        <th>Appointment ID</th>
        <th>DATE</th>
        <th>TIME</th>
        <th>Patient Name</th>
        <th>Patient Email</th>
        <th>Doctor Name</th>
        <th>Category</th>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $DocName = $mysqli->real_escape_string($_POST['docName']);
    $sql = "SELECT * FROM appointment WHERE DoctorName = ('$DocName')";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) == 1) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["AppoID"] . "</td><td>" . $row["Date"] . "</td><td>" . $row['Time'] . "</td><td>" . $row["PatientName"] . "</td><td>" . $row["PatientEmail"] . "</td><td>" . $row["DoctorName"] . "</td><td>" . $row['Category'] . "</td></tr>";
        }
        echo "</table";
    }
    }
    ?>
</table>
</body>
</html>

