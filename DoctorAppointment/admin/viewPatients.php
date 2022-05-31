<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../css/stylesAdmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap"
          rel="stylesheet">
</head>
<header>
    <h1>Doctor<span>Patient</span></h1>
    <nav>
        <ul>
            <li><a href="index.php">Add/Delete Doctor</a></li>
            <li><a href="viewDoctors.php">View Doctors</a></li>
            <li><a href="viewPatients.php">View Patients</a></li>
            <li><a href="viewAppointments.php">View Appointments</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<h1 style="margin-left:35% ;margin-top:80px" class="asd">Patients Information</h1>
<table class="table4">
    <tr>
        <th>Patient ID</th>
        <th>Patient Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
    </tr>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $query = "SELECT  * FROM  patient ";
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["PatientID"] . "</td><td>" . $row["PatientName"] . "</td><td>" . $row['Email'] . "</td><td>" . $row["Address"] . "</td><td>" . $row["ContactNumber"] . "</td></tr>";
        }
        echo "</table";
    }
    ?>
</table>
</body>
</html>