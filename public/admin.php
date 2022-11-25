<?php

session_start();

$username = "";
$password = "";
if (isset($_POST["adminUsername"]) && isset($_POST["adminPassword"])) {
    $username = $_POST["adminUsername"];
    $password = $_POST["adminPassword"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["loginToAdmin"])) {
    if (strcmp($username, "admin") == 0 && strcmp($password, "strongpassword1") == 0) {
        header("Location: ./admin/adminpanel.php");
        unset($_POST);
        exit;
    }
} else {
    echo "Wrong username or password!";
    unset($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
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

    <?php include "./view/header.php";
    sendNavBar("admin") ?>

    <div class="centered">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="imgcontainer">
                <h1>Login to the Admin Panel</h1>
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="adminUsername" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="adminPassword" required>

                <button type="submit" name="loginToAdmin">Login</button>
            </div>
        </form>
        <p id="error"></p>
    </div>
</body>

</html>