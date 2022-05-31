<!DOCTYPE html>
<html>
<head>
	<title>Patient</title>
	<link rel="stylesheet"  href="../css/stylesPatient.css">

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
<form method="post" action="cancel.php">

	<div class="input-group">
        <label style="font-weight: bold; font-size: 30px">Appointment ID:</label>
		<input type="text" name="AID" placeholder="Enter Your Appointment ID" required>
	</div>

	<div class="input-group">
		<button type="submit" name="Cancel" class="btn">Cancel</button>
	</div>
<?php
if (isset($_POST['Cancel'])) {
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    $AID = $mysqli->real_escape_string($_POST['AID']);
    $sql = "SELECT * FROM appointment WHERE AppoID = ('$AID')";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $deleteStmt = $mysqli->prepare("DELETE FROM appointment WHERE AppoID = ?");
        $deleteStmt->bind_param("i", $AID);
        $deleteStmt->execute();
        $deleteStmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Appointment deleted successfully")';
        echo '</script>';
    }
}
?>
</form>
</body>
</html>


