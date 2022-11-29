<?php
session_start();
require "../config/config.php";
if (!isset($_SESSION["loggedIn"])) {
    header("Location: ../login.php");
    exit;
}
$success = "";
$error = "";
$email = $_SESSION["email"];
$fullname = $_SESSION["fullName"];
if ($_GET["ordered"] == "true") {
    $success = "Successfully ordered!";
}

$userID = $_SESSION["userID"];
$sql = "SELECT * FROM reservations WHERE userID = '$userID'";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["reserved"] = false;
        consoleLog($_SESSION["reserved"]);
    } else {
        $_SESSION["reserved"] = true;
        consoleLog($_SESSION["reserved"]);
    }
}


if (isset($_POST["makeReservation"]) && $_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["reserved"] == false) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $date = $_POST["date"];
    $people = $_POST["people"];
    $time = $_POST["time"];
    $userID = $_SESSION["userID"];
    $comments = isset($_POST["comments"]) ? $_POST["comments"] : "";
    $sql = "INSERT INTO reservations VALUES ('default', '$userID', '$firstName', '$lastName', '$telephone', '$email', '$date', '$time', '$people','$comments')";
    if (mysqli_query($link, $sql)) {
        $success = "Reservation made successfully.";
        $_SESSION["reservationID"] = mysqli_insert_id($link);
        unset($_POST);
        $_SESSION["reserved"] = true;
    } else {
        $error = "Error occurred while trying to make the reservation!" . mysqli_error($link);
        $_SESSION["reserved"] = false;
    }
}
if (isset($_POST["cancelBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $lastID = $_POST['cancelBtn'];
    $deleteSQL = "DELETE FROM reservations WHERE reservationID = '$lastID'";
    if (mysqli_query($link, $deleteSQL)) {
        $success = "Deleted reservation successfully.";
        $_SESSION["reserved"] = false;
        $deleteSQL = "DELETE FROM orders WHERE reservationFullName = '$fullname'";
        if (mysqli_query($link, $deleteSQL)) {
            $_SESSION["ordered"] = false;
        }
    } else {
        $error = "Error occurred";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userpanel</title>
    <link rel="stylesheet" href="../../assets/style.css">
    <style>
        .success {
            color: lime;
            font-size: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
        }

        .center {

            margin-left: auto;
            margin-right: auto;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #ddd;
            margin-top: 120px;

        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        * {
            overflow: hidden;
        }

        .container {
            padding: 16px;
        }

        form {
            margin-top: 50px;
        }

        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        .form-popup {
            display: none;
            position: fixed;
            overflow-y: auto;
            bottom: 0;
            right: 15px;
            z-index: 9;
        }

        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        .form-container input[type=text],
        .form-container input[type=email],
        .form-container input[type=tel],
        .form-container input[type=date],
        .form-container input[type=time],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: none;
            background: #f1f1f1;
        }

        .form-container textarea {
            resize: none;
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            height: 50%;

        }

        .form-container input[type=text]:focus,
        .form-container input[type=email]:focus,
        .form-container input[type=tel]:focus,
        .form-container input[type=date]:focus,
        .form-container input[type=time]:focus,
        .form-container select:focus {
            background-color: #ddd;
            outline: none;
        }

        .form-container .close {
            float: right;
            border-radius: 5px;
            border: none;
            color: red;
            cursor: pointer;
        }

        .cancel {
            background-color: red;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .form-container .btn {
            background-color: #0096FF;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }


        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php include "../view/header.php";
    sendNavBar("userPanel") ?>

    <div class="top-left">
        <h2>Welcome back,<span class="inform">
                <?php echo $_SESSION["fullName"] ?>
                <p id="error">
                    <?php echo isset($error) ? $error : "" ?>
                </p>
                <p class="success">
                    <?php echo isset($success) ? $success : "" ?>
                </p>
            </span>
        </h2>
    </div>
    <div class="top-right">
        <button class="open-button" onclick="openForm()">Open reservation form</button>
        <div class="form-popup" id="myForm">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">
                <button class="close" onclick="closeForm()">&times;</button>
                <label for="firstname"><b>First name</b></label>
                <input type="text" name="firstname" id="firstname" value="<?php echo isset($_SESSION["firstName"]) ? $_SESSION["firstName"] : '' ?>" placeholder="Enter your first name." required>

                <label for="lastname"><b>Last name</b></label>
                <input type="text" name="lastname" id="lastname" value="<?php echo isset($_SESSION["lastName"]) ? $_SESSION["lastName"] : '' ?>" placeholder=" Enter your last name." required>

                <label for="telephone"><b>Telephone</b></label>
                <input type="tel" name="telephone" id="telephone" value="<?php echo isset($_SESSION["telephone"]) ? $_SESSION["telephone"] : '' ?>" placeholder="Enter your phone number." required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter your email." value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : '' ?>" name="email" id="email" required>
                <label for="people">Number of people</label>
                <select name="people" id="people" required>
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <label for="date"><b>Reservation date</b></label>
                <input type="date" name="date" id="date" required>

                <label for="time"><b>Reservation time</b></label>
                <select name="time" required>
                    <option name="20:00">20:00</option>
                    <option name="20:30">20:30</option>
                    <option name="21:00">21:00</option>
                    <option name="21:30">21:30</option>
                    <option name="22:00">22:00</option>
                    <option name="22:30">22:30</option>
                </select>

                <textarea name="comments" id="comments"></textarea>

                <button type="submit" class="btn" name="makeReservation">Submit</button>
            </form>
        </div>
    </div>
    <table class="center">
        <tr>
            <th>Reservation ID</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>Number of people reserved</th>
        </tr>
        <?php
        $email = $_SESSION["email"];
        $sql = "SELECT * from reservations where email = '$email'";
        $result = mysqli_query($link, $sql);
        $btn = "";
        if (!$result) {
            $error = "Could not load info.";
        } else {
            while ($row = $result->fetch_assoc()) {
                $reservationID = $row['reservationID'];
                echo "<tr>
            <td>" . $row["reservationID"] . "</td>
            <td>" . $row["date"] . "</td>
            <td>" . $row["time"] . "</td>
            <td>" . $row["people"] . "</td>
            <td>" . "<form action='./userpanel.php' method='POST'><button class='cancel' name='cancelBtn' value='$reservationID'>Cancel reservation</button></form>" . "</td>
            </tr>";
            }
        }
        ?>
    </table>

    <script type="text/javascript">
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }



        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
</body>

</html>