<?php
session_start();


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
    </style>
</head>

<body>
    <?php include "../view/header.php";
    sendNavBar("userPanel") ?>

    <div class="top-left">
        <h2>Welcome back,<span class="inform">
                <?php echo $_SESSION["fullName"] ?>
            </span>
        </h2>
    </div>
    <table class="center">
        <tr>
            <th>Reservation ID</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>Number of people reserved</th>
        </tr>
    </table>
</body>

</html>