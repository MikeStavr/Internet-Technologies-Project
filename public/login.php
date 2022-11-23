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
    <?php
    include './view/header.php';
    sendNavBar("login");
    ?>
    <div class="centered">
        <form action="userpanel.php" method="post">
            <div class="imgcontainer">
                <h1>Login</h1>
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
                <div class="container">
                    <p>No account? <a href="./register.php" class="register"
                            title="Click here to visit the register form.">Register</a> now!</p>
                </div>
            </div>
        </form>
    </div>


</body>

</html>