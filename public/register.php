<?php
session_start();

require_once("./config/config.php");
$error = "";
if (isset($_POST["register"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result)) {
        $error = "Error: Email already being used.";
    } else {
        $sql = "INSERT INTO users VALUES ('default', '$firstname', '$lastname', '$telephone', '$email', '$hashedPassword');";
        if (mysqli_query($link, $sql)) {
            consoleLog("Successfully registered.");
            header("Location: ./login.php");
            exit;
        } else {
            $error = "Error: Could process register.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        * {
            overflow: hidden;
        }

        .container {
            padding: 16px;
        }

        input[type=text],
        input[type=password],
        input[type=tel] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .registerbtn {
            background-color: #0096FF;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        a {
            color: #0096FF;
        }
    </style>
</head>

<body>
    <?php
    include "./view/header.php";
    sendNavBar("register");
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="container centered">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="firstname"><b>First name</b></label>
            <input type="text" name="firstname" id="firstname" placeholder="Enter your first name." required>

            <label for="lastname"><b>Last name</b></label>
            <input type="text" name="lastname" id="lastname" placeholder="Enter your last name." required>

            <label for="telephone"><b>Telephone</b></label>
            <input type="tel" name="telephone" id="telephone" placeholder="Enter your phone number." required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter your email." name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter your password." name="password" id="password" minlength="8" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat your password." name="password-repeat" id="password-repeat" minlength="8" required>
            <hr>
            <input type="submit" name="register" class="registerbtn" value="Register">
            <p id="error">
                <?php echo !empty($error) ? $error : ""
                ?>
            </p>
        </div>
    </form>

</body>

</html>