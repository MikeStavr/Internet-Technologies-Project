<?php
session_start();

require_once "./config/config.php";

$error = "";
$email = "";
$password = "";

if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
    header("Location: ./user/userpanel.php");
    exit;
}

if (isset($_POST["login"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $sql = "SELECT userID, firstname, lastname, telephone, email, password FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $telephone, $email, $hashedPassword);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashedPassword)) {
                        session_start();

                        $_SESSION["loggedIn"] = true;
                        $_SESSION["userID"] = $id;
                        $_SESSION["firstName"] = $firstname;
                        $_SESSION["lastName"] = $lastname;
                        $_SESSION["fullName"] = $firstname . " " . $lastname;
                        $_SESSION["telephone"] = $telephone;
                        $_SESSION["email"] = $email;
                        header("Location: ./user/userpanel.php");
                    } else {
                        $error = "Invalid username or password.";
                    }
                }
            } else {
                $error = "Invalid username or password.";
            }

        } else {
            echo "Something went wrong. Contact an administrator.";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        form {
            border: 3px solid #f1f1f1;
        }

        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #0096FF;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }


        .container {
            padding: 16px;
        }

        .register {
            color: black;
        }

        a:visited {
            color: black;
        }
    </style>
</head>

<body>
    <?php
    include './view/header.php';
    sendNavBar("login");
    ?>
    <div class="centered">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="imgcontainer">
                <h1>Login</h1>
            </div>

            <div class="container">
                <label for="Email"><b>Email</b></label>
                <input type="email" placeholder="Enter your email." name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" name="login">Login</button>
                <div class="container">
                    <p>No account? <a href="./register.php" class="register"
                            title="Click here to visit the register form.">Register</a> now!</p>
                </div>
            </div>
        </form>
        <p id="error">
            <?php echo !empty($error) ? $error : ""; ?>
        </p>
    </div>


</body>

</html>