<?php
$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['adminID']) && isset($_POST['adminPassword'])) {
    $AdminID = stripslashes($_POST["adminID"]);
    $Password = sha1($_POST["adminPassword"]);
    $IDErr = $PassErr = "";

    // Validate email
    ?>
    <form action="admin/index.php" id="f1">
        <?php
        if (empty(trim($_POST["adminID"]))) {
            $IDErr = "Please enter an ID.";
        } else {
            // Prepare a select statement
            $sql = "SELECT * FROM admin WHERE AdminID = ?";

            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $paramID);

                // Set parameters
                $paramID = trim($_POST["AdminID"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $IDErr = "This id is already taken.";
                    } else {
                        $AdminID = trim($_POST["AdminID"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["adminPassword"]))) {
            $PassErr = "Please enter a password.";
        } else {
            $Password = trim($_POST["adminPassword"]);
        }
        ?>
    </form>
    <?php
    // Check input errors before inserting in database
    if (empty($IDErr) && empty($PasswordErr)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $AdminID;
            $param_password = password_hash($Password, PASSWORD_DEFAULT); // Creates a password hash
            ?>
            <script type="text/javascript">
                document.getElementById("f1").submit();
            </script>
            <?php
        }}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="css/stylesLoginAdmin.css">
</head>
<body class="Abody">
	<div class="Aheader">
	<h2>Admin Log In</h2>
</div>

<form method="post" action="admin/index.php" class="Aform">

	<div class="input-groupA">
		<label>Admin ID</label>
		<input type="text" name="adminID" placeholder="Enter your ID" required>

	</div>

	<div class="input-groupA">
		<label>Password</label>
		<input type="password" name="adminpassword" placeholder="Enter your Password" required>

	<div class="input-groupA">
		<button type="submit" name="Login3" class="btnA">Login</button>
	</div>

</form>
</body>
</html>