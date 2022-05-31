<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient</title>
    <link rel="stylesheet" type="text/css" href="css/stylesLoginPatient.css">
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>
<?php
$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['Register'])) {

    $PatientName = $_POST['PatientName'] ?? "";
    $Email = $_POST['Email'] ?? "";
    $Address = $_POST['Address'] ?? "";
    $ContactNumber = $_POST['ContactNumber'] ?? 0;
    $Password = $_POST['Password'] ?? "";

    // cauta daca exista un rand cu id-ul respectiv
    $stmt = $mysqli->prepare("SELECT * FROM patient WHERE Email = ?");
    $stmt->bind_param("s", $_POST['Email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // daca exista => update
    if ($result->num_rows > 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Email already exists!")';
        echo '</script>';
    } else {
        // daca nu exista => create
        $createStmt = $mysqli->prepare("INSERT INTO patient (PatientName, Email, Address, ContactNumber, Password) VALUES (?, ?, ?, ?, ?)");
        $createStmt->bind_param("sssis", $PatientName, $Email, $Address, $ContactNumber, $Password);
        $createStmt->execute();
        $createStmt->close();
        $createStmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $createStmt->bind_param("ss", $Email, $Password);
        $createStmt->execute();
        $createStmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Registered successfully")';
        echo '</script>';
    }
}
?>
<form method="post" action="registerPatient.php">

    <div class="input-group">
        <label>Name</label>
        <input type="text" name="PatientName">
    </div>

    <div class="input-group">
        <label>Address</label>
        <input type="text" name="Address">
    </div>

    <div class="input-group">
        <label>Contact Number</label>
        <input type="number" name="ContactNumber">
    </div>

    <div class="input-group">
        <label>Email address</label>
        <input type="email" name="Email">
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="Password">
    </div>

    <div class="input-group">
        <button type="submit" name="Register" class="btn">Register</button>
    </div>

    <p>
        Already a member? <a href="loginPatient.php">Sign in </a>
    </p>

</form>
</body>
</html>

