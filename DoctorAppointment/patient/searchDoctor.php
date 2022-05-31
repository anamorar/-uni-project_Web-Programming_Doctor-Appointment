<!DOCTYPE html>
<html>
<head>
    <title>Patient</title>
    <link rel="stylesheet" href="../css/stylesPatient.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap"
          rel="stylesheet">
</head>
<header>
    <h1>Doctor<span>Patient</span></h1>
    <nav>
        <ul>
            <li><a href=" index.php">MyInfo</a></li>
            <li><a href=" book.php">Book Appointment</a></li>
            <li><a href=" view.php">View Appointment</a></li>
            <li><a href=" cancel.php">Cancel Appointment</a></li>
            <li><a href="searchDoctor.php">Search Doctor</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<form method="post" action="searchDoctor.php">

    <div class="input-group">

        <label style="font-weight: bold; font-size: 30px">Search Doctor by:</label>
        <label style="font-weight: bold">Name/Category</label>
        <input type="text" name="DID">
    </div>

    <div class="input-group">
        <button type="submit" name="Search" class="btn">Search</button>
    </div>

</form>
<?php
if (isset($_POST['Search'])) {
?>
<table class="table2">
    <caption style="margin-left: 34px;padding: 10px;font-weight: bold;font-size: 30px;" class="asd">Doctor
        Information
    </caption>
    <tr>
        <th>Doctor ID</th>
        <th>Doctor Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
        <th>Category</th>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $DID = $mysqli->real_escape_string($_POST['DID']);
    $sql = "SELECT * FROM doctor WHERE Doctorname=('$DID') OR Category=('$DID')";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) == 1) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["DoctorID"] . "</td><td>" . $row["DoctorName"] . "</td><td>" . $row['Email'] . "</td><td>" . $row["Address"] . "</td><td>" . $row["ContactNumber"] . "</td><td>" . $row['Category'] . "</td></tr>";
        }
        echo "</table";
    }
    }
?>
</table>
</body>
</html>


