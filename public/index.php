<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant website</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include './view/header.php';
    sendNavBar("home");
    ?>
    <div class="bg"></div>
    <div class="wrapper">
        <div class="top-left">
            <p>Working hours:</p>
            <ul>
                <li>20:00 - 23:00</li>
            </ul>
        </div>
        <div class="centered middle-box">
            <h1>Restaurant</h1>
            <h2><a href="./login.php">Login</a> to book your table!</h2>
        </div>
    </div>
</body>

</html>