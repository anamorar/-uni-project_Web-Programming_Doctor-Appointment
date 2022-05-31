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
            <li><a href="index.php">MyInfo</a></li>
            <li><a href="book.php">Book Appointment</a></li>
            <li><a href="view.php">View Appointment</a></li>
            <li><a href="cancel.php">Cancel Appointment</a></li>
            <li><a href="searchDoctor.php ">Search Doctor</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<div class="header">
    <h2>Book Appointment</h2>
</div>
<form method="post" action="book.php">
    <div class="input-group">
        <label>Category</label>
        <select name="category" class="xd">
            <option value="Bones">Bones</option>
            <option value="Heart">Heart</option>
            <option value="Dentistry">Dentistry</option>
            <option value="MentalHealth">Mental Health</option>
            <option value="Surgery">Surgery</option>
        </select>
    </div>
    <div class="input-group">
        <button type="submit" name="Search" class="btn">Search</button>
    </div>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "uni_db");
    if (isset($_POST['Search'])) {
        $Category = mysqli_real_escape_string($mysqli, $_POST['category']);

        $query2 = "SELECT * FROM doctor WHERE Category=('$Category')";
        $result2 = mysqli_query($mysqli, $query2);
        ?>
        <div class="input-group">
            <label>Doctor Name</label>
            <select class="input-group2" name="docName">
                <?php while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                    <option> <?php echo $row2['DoctorName'] ?> </option>
                    <?php
                } ?>
            </select>
        </div>

        <div class="input-group">
            <label>Name</label>
            <input type="text" name="PatientName" placeholder="Enter your Name" >
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="PatientEmail" placeholder="Enter your Email" >
        </div>

        <div class="input-group">
            <label>Date</label>
            <input type="date" name="Date" >
        </div>

        <div class="input-group">
            <label>Time</label>
            <input type="time" name="Time" >
        </div>

        <div class="input-group">
            <button type="submit" name="Book" class="btn">BOOK</button>
        </div>
        <?php
    }

    if (isset($_POST['Book'])) {

        $DoctorName = $_POST['docName'] ?? "";
        $PatientName = $_POST['PatientName'] ?? "";
        $PatientEmail = $_POST['PatientEmail'] ?? "";
        $Date = $_POST['Date']; //date('d-m-Y', strtotime($_POST['Date']));
        $Time = $_POST['Time']; //date('h-i', strtotime($_POST['Time']));
        $Category1 = $_POST['category'] ?? "";

        $stmt = $mysqli->prepare("INSERT INTO  appointment (Date,Time,PatientName,PatientEmail,DoctorName,Category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $Date,$Time,$PatientName,$PatientEmail,$DoctorName,$Category1);
        $stmt->execute();
        $stmt->close();
        echo '<script type="text/javascript">';
        echo ' alert("Appointment booked with success!")';
        echo '</script>';
//        session_start();
//        if (isset($_POST['PatientID']) && isset($_POST['Date']) && isset($_POST['Time']) && isset($_POST['DoctorID'])) {
//            $PatientID = $_POST['PatientID'];
//            $Time = $_POST['Time'];
//            $DoctorID = $_POST['DoctorID'];
//            $Date = $_POST['Date'];
//            $query = "INSERT INTO bookappointment(Date,Time,PatientID,DoctorID) VALUES('$Date','$Time','$PatientID','$DoctorID')";
//
//            $result = $mysqli->query($query);
//            if ($result) {
//                header("location:book.php");
//            } else {
//                sleep(3);
//                echo "Appointment not Created.";
//                sleep(3);
//                header("location:index.php");
//            }
//        }

//        echo $_SESSION['user'];
//
//        $DoctorName = $_POST['docName'] ?? "";
//        $PatientID = $_GET['PatientID'] ?? 0;
//        echo "PatientID:" . $PatientID;
//
//        // cauta daca exista un rand cu id-ul respectiv
//        $stmt = $mysqli->prepare("SELECT DoctorID FROM doctor WHERE DoctorName = ?");
//        $stmt->bind_param("s", $_POST['docName']);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $result2 = $result->fetch_assoc();
//        $stmt->close();
//        foreach ($result2 as $value) {
//            $DoctorID = $value;
//        }
//
//        $id_stm = $mysqli->prepare("SELECT PatientID FROM patient WHERE Email = ?");
//        echo "Email:" . $_SESSION['Email'];
//        $id_stm->bind_param("s", $_SESSION["Email"]);
//        $id_stm->execute();
//        $id = $id_stm->get_result();
//        $results = $id->fetch_assoc();
//        $id_stm->close();
//        foreach ($results as $value) {
//            $PatientID = $value;
//            echo "PID:" . $PatientID;
//        }
//
//
//        $Date = $mysqli->real_escape_string($_POST['Date']);
//        $Time = $mysqli->real_escape_string($_POST['Time']);
//
//        $PatientID = $_REQUEST['PatientID'];
//        $DoctorID = $_POST['DoctorID'];
//        $sql = "INSERT INTO  bookappointment (Date, Time, PatientID, DoctorID) VALUES ('$Date','$Time','$PatientID','$DoctorID') ";
//        $results = $mysqli->query($sql);
//
//        if ($results) {
//            printf("%d Booked .\n", $mysqli->affected_rows);
//
//        } elseif (!$mysqli->query($sql)) {
//            printf("%d Can't Book At The Moment.\n", $mysqli->affected_rows);
//        }
//
//        header('Location:book.php');
//

    }
    ?>
</form>
</body>
</html>