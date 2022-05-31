<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../css/stylesAdmin.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
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
<div class="headerA">
    <h2>Add Doctor</h2>
</div>
<?php
$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['Add'])) {

    $DoctorName = $_POST['addName'] ?? "";
    $Email = $_POST['addEmail'] ?? "";
    $Address = $_POST['addAddress'] ?? "";
    $ContactNumber = $_POST['addContactNumber'] ?? 0;
    $Password = $_POST['addPassword'] ?? "";
    $Category = $_POST['addCategory'] ?? "";

    // cauta daca exista un rand cu id-ul respectiv
    $stmt = $mysqli->prepare("SELECT * FROM doctor WHERE Email = ?");
    $stmt->bind_param("s", $_POST['addEmail']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // daca exista => update
    if ($result->num_rows > 0) {
        $updateStmt = $mysqli->prepare("UPDATE doctor SET DoctorName = ?, Address=?, ContactNumber=?, Password=?, Category=? WHERE Email = ?");

        $updateStmt->bind_param("sssiss", $DoctorName, $Address, $ContactNumber, $_POST['Password'], $Category, $_POST['Email']);
        $updateStmt->execute();
        $updateStmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Doctor updated successfully")';
        echo '</script>';
    } else {
        // daca nu exista => create
        $createStmt = $mysqli->prepare("INSERT INTO  doctor (DoctorName, Email, Address, ContactNumber, Password, Category) VALUES (?, ?, ?, ?, ?, ?)");
        $createStmt->bind_param("sssiss", $DoctorName,$Email,$Address,$ContactNumber,$Password, $Category);
        $createStmt->execute();
        $createStmt->close();
        $createStmt = $mysqli->prepare("INSERT INTO  users (username, password) VALUES (?, ?)");
        $createStmt->bind_param("ss",$Email,$Password);
        $createStmt->execute();
        $createStmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Doctor added successfully")';
        echo '</script>';
    }
}
?>
<form method="post" action="index.php">

    <div class="input-groupA">
        <label>Doctor Name</label>
        <input type="text" name="addName">
    </div>

    <div class="input-groupA">
        <label>Address</label>
        <input type="text" name="addAddress">
    </div>

    <div class="input-groupA">
        <label>Contact Number</label>
        <input type="number" name="addContactNumber">
    </div>

    <div class="input-groupA">
        <label>Email address</label>
        <input type="email" name="addEmail">
    </div>

    <div class="input-groupA">
        <label>Password</label>
        <input type="password" name="addPassword">
    </div>

    <div class="input-groupA">
        <label>Category</label>
        <select name="addCategory" class="xd">
            <option value="Bones">Bones</option>
            <option value="Heart">Heart</option>
            <option value="Dentistry">Dentistry</option>
            <option value="MentalHealth">Mental Health</option>
            <option value="Surgery">Surgery</option>
        </select>
    </div>

    <div class="input-groupA">
        <button type="submit" name="Add" class="btnA">Add Doctor</button>
    </div>

</form>
    <div class="headerAD">
        <h2>Delete Doctor</h2>
    </div>
<?php
$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['Delete'])) {

    $DoctorID = $_POST['deleteID'] ?? 0;

    // cauta daca exista un rand cu id-ul respectiv
    $stmt = $mysqli->prepare("SELECT * FROM doctor WHERE DoctorID = ?");
    $stmt->bind_param("i", $_POST['deleteID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // daca exista => sterge
    if ($result->num_rows > 0) {
        $deleteStmt = $mysqli->prepare("DELETE FROM doctor WHERE DoctorID = ?");
        $deleteStmt->bind_param("i", $DoctorID);
        $deleteStmt->execute();
        $deleteStmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Doctor deleted successfully")';
        echo '</script>';
    }
}
?>
<form method="post" action="index.php" class="delete">

    <div class="input-groupA">
        <label>Doctor ID</label>
        <input type="text" name="deleteID">
    </div>

    <div class="input-groupA">
        <button type="submit" name="Delete" class="btnA">Delete Doctor</button>
    </div>
</form>
</body>
</html>