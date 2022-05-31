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
            <li><a href="index.php">MyInfo</a></li>
            <li><a href="book.php">Book Appointment</a></li>
            <li><a href="view.php">View Appointment</a></li>
            <li><a href="cancel.php">Cancel Appointment</a></li>
            <li><a href="searchDoctor.php">Search Doctor</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<div class="headerP"
     style="width: 15%;margin-top: 60px;color: white;background: #39ca74;text-align: center;border-radius: 10px 10px 5px 5px;border-bottom: none; border :1px solid #39ca74;padding: 10px;margin-left:-4px   ">
    <h2>My Informations</h2>
</div>
<form method="get" action="../loginPatient.php" class="infoP">
    <div class="Pcontent">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "uni_db");
        $PID = $mysqli->real_escape_string($_POST['Email']);
        $sqlP = "SELECT * FROM patient WHERE Email=('$PID')";
        $resultP = $mysqli->query($sqlP);
        if (mysqli_num_rows($resultP) == 1) {
            while ($row = $resultP->fetch_assoc()) {
                ?>
                <label>ID </label>
                <input type="text" placeholder="Enter your ID" value="<?php echo $row['PatientID']; ?>" required />
                <br>
                <br>
                <label>Name </label>
                <input type="text" placeholder="Enter your Name" value="<?php echo $row['PatientName']; ?>" required />
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
                <?php
            }
        }
        ?>
    </div>
</form>


</body>
</html>
