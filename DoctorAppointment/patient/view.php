<!DOCTYPE html>
<html>
<head>
    <title>Patient</title>
    <link rel="stylesheet" href="../css/stylesPatient.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>
<header>
    <h1>Doctor<span>Patient</span></h1>
    <nav>
        <ul>
            <li><a href=" index.php">MyInfo</a></li>
            <li><a href=" book.php">Book Appointment</a></li>
            <li><a href=" view.php">View Appointment</a></li>
            <li><a href="cancel.php">Cancel Appointment</a></li>
            <li><a href="searchDoctor.php ">Search Doctor</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<!--<h1 class="my">My<span class="mys">Appointments</span></h1>-->
<form method="post" action="view.php">
    <div class="input-group">
        <label style="font-weight: bold; font-size: 30px">Appointment ID:</label>
        <input type="text" name="AID" placeholder="Enter Your Appointment ID" required>
    </div>

    <div class="input-group">
        <button type="submit" name="Search" class="btn">Search</button>
    </div>
</form>
<?php
if (isset($_POST['Search'])) {
?>
<table class="table2">
    <caption style="margin-left: 34px;padding: 10px;font-weight: bold;font-size: 30px;" class="asd">Appointment Details
    </caption>
    <tr>
        <th>Appointment ID</th>
        <th>DATE</th>
        <th>TIME</th>
        <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Category</th>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $AID = $mysqli->real_escape_string($_POST['AID']);
    $sql = "SELECT * FROM appointment WHERE AppoID = ('$AID')";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) == 1) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["AppoID"] . "</td><td>" . $row["Date"] . "</td><td>" . $row['Time'] . "</td><td>" . $row["PatientName"] . "</td><td>" . $row["DoctorName"] . "</td><td>" . $row['Category'] . "</td></tr>";
        }
        echo "</table";
    }
    }
    ?>
</table>
</body>
</html>

