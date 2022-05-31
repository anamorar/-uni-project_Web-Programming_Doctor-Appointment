<?php
$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['Email']) && isset($_POST['Password'])) {
    $Email = stripslashes($_POST["Email"]);
    $Password = sha1($_POST["Password"]);
    $EmailErr = $PasswordErr = "";

    // Validate email
    ?>
    <form action="doctor/index.php" id="f1">
        <?php
        if (empty(trim($_POST["Email"]))) {
            $EmailErr = "Please enter an email.";
        } else {
            // Prepare a select statement
            $sql = "SELECT DoctorID FROM doctor WHERE Email = ?";

            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $paramEmail);

                // Set parameters
                $paramEmail = trim($_POST["Email"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $EmailErr = "This email is already taken.";
                    } else {
                        $Email = trim($_POST["Email"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["Password"]))) {
            $PasswordErr = "Please enter a password.";
        } else {
            $Password = trim($_POST["Password"]);
        }
        ?>
    </form>
    <?php
    // Check input errors before inserting in database
    if (empty($EmailErr) && empty($PasswordErr)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $Email;
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
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="css/stylesLoginDoctor.css">
</head>
<body class="Dbody">
	<div class="Dheader">
	<h2>Doctor Log In</h2>
</div>

<form method="post" action="doctor/index.php" class="Dform">

	<div class="input-groupD">
		<label>Email</label>
		<input type="text" name="Email" placeholder="Enter your Email" required>
	</div>

	<div class="input-groupD">
		<label>Password</label>
		<input type="Password" name="Password"placeholder="Enter your Password" required>

	<div class="input-groupD">
		<button type="submit" name="Login2" class="btnD">Login</button>
	</div>

</form>
</body>
</html>