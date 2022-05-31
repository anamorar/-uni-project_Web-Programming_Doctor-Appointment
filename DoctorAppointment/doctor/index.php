<!DOCTYPE html>
<html>
<head>
    <title>Doctor</title>
    <link rel="stylesheet" href="../css/stylesDoctor.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>
<header>
    <h1>Doctor<span>Patient</span></h1>
    <nav>
        <ul>
            <li><a href="index.php">MyInfo</a></li>
            <li><a href="appointments.php">My Appointments</a></li>
            <li><a href="searchPatient.php">Search Patient</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<div class="header">
    <h2>My Informations</h2>
</div>
<form method="post" action="index.php" class="info">
    <div class="Dcontent">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "uni_db");
        $DID = $mysqli->real_escape_string($_POST['Email']);
        $sqlD = "SELECT * FROM doctor WHERE Email=('$DID')";
        $resultD = $mysqli->query($sqlD);
        if (mysqli_num_rows($resultD) == 1) {
            while ($row = $resultD->fetch_assoc()) {
        ?>
                <label>ID </label>
                <input type="text" placeholder="Enter your ID" value="<?php echo $row['DoctorID']; ?>" required />
                <br>
                <br>
                <label>Name </label>
                <input type="text" placeholder="Enter your Name" value="<?php echo $row['DoctorName']; ?>" required />
                <br>
                <br>
                <label>Email </label>
                <input type="text" placeholder="Enter your Email" value="<?php echo $row['Email']; ?>" required />
                <br>
                <br>
                <label>Address </label>
                <input type="text" placeholder="Enter your Address" value="<?php echo $row['Address']; ?>" required />
                <br>
                <br>
                <label>Contact Number </label>
                <input type="text" placeholder="Enter your Contact Number" value="<?php echo $row['ContactNumber']; ?>" required />
                <br>
                <br>
                <label>Specialized In </label>
                <input type="text" placeholder="Enter your Category" value="<?php echo $row['Category']; ?>" required />
                <br>
                <?php
            }
        }
        ?>
    </div>
</form>
</body>
</html>