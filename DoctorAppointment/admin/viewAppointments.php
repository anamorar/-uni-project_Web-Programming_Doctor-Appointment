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
            <li><a href=" viewPatients.php">View Patients</a></li>
            <li><a href="viewAppointments.php">View Appointments</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<h1 style="margin-left:40% ;margin-top:80px" class="asd"> Appointments </h1>
<table class="table4">
    <tr>
        <th>Appointment ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Patient Name</th>
        <th>Patient Email</th>
        <th>Doctor Name</th>
        <th>Category</th>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $sql3 = "SELECT  * FROM  appointment ";
    $result3 = $mysqli->query($sql3);
    if (mysqli_num_rows($result3) >= 1) {
        while ($row3 = $result3->fetch_assoc()) {
            echo "<tr><td>" . $row3["AppoID"] . "</td><td>" . $row3["Date"] . "</td><td>" . $row3["Time"] . "</td><td>" . $row3["PatientName"] . "</td><td>" . $row3['PatientEmail'] . "</td><td>" . $row3['DoctorName'] . "</td><td>" . $row3['Category'] . "</td></tr>";
        }
        echo "</table";
    }
    ?>
</table>
</body>
</html>