<?php
require("../config/config.php");
if (isset($_POST["uploadFile"]) && $_POST["uploadFile"] == "Upload file") {
    if (isset($_FILES["menuFile"]) && $_FILES["menuFile"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["menuFile"]["name"];
        $fileTmpPath = $_FILES["menuFile"]["tmp_name"];

        if ($fileName == "menu_main.xml" || $fileName == "menu_dessert.xml") {
            $ext = pathinfo($_FILES["menuFile"]["name"], PATHINFO_EXTENSION);
            if ($ext == "xml") {
                $fullFileName = $fileName;

                $uploadDir = "../../assets/menus/";
                $dest_path = $uploadDir . $fullFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo "File uploaded successfully!";
                    unset($_POST);
                    unset($_FILES);
                } else {
                    echo "Error occurred while uploading file.";
                    unset($_POST);
                }
            } else {
                echo "File extension not allowed. Only .xml is allowed.";
                unset($_POST);
            }
        } else {
            echo "Error selecting the file.";
            unset($_POST);
        }
    }
}

$error = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/style.css">
    <style>
        body {
            overflow: auto;
            margin-top: 50px;
        }

        .topnav {
            z-index: 9;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .column {
            float: left;
            width: 50%;
            padding: 5px;
        }

        .half {
            width: 25;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .full table {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include "../view/header.php";
    sendNavBar("adminPanel");
    ?>
    <div class="top-left">
        <form action=" ./adminpanel.php" method="POST" enctype="multipart/form-data">
            <p>Upload <a href="../../assets/templates/menu_main.xml" title="Click to download the template."
                    download="menu_main.xml" style="color:black;">menu_main.xml</a> for the main
                menu. <br>
                Upload <a href="../../assets/templates/menu_dessert.xml" title="Click to download the template."
                    download="menu_dessert.xml" style="color:black;">menu_dessert.xml</a>
                for the desserts menu.</p>
            <input type="file" name="menuFile" id="menuFile">
            <br><br>
            <input type="submit" name="uploadFile" id="uploadFileBtn" value="Upload file" accept=".xml">
        </form>
    </div>
    <br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="column">
            <h1>Main menu:</h1>
            <table>
                <tr>
                    <th>Dish Name</th>
                    <th>Dish description</th>
                    <th>Dish price</th>
                </tr>
                <?php
                if (file_exists("../../assets/menus/menu_main.xml")) {
                    $xmlFile = simplexml_load_file("../../assets/menus/menu_main.xml");

                    foreach ($xmlFile->dishes->dish as $child) {

                        echo "<tr>
                        <td>" . $child->dishName . "</td>
                        <td>" . $child->dishDescription . "</td>
                        <td>" . $child->dishPrice . "</td>
                        </tr>";
                    }
                } else {
                    echo "<p>Template file of how the menu would look like.</p>";
                    $xmlFile = simplexml_load_file("../../assets/templates/menu_main.xml");
                    foreach ($xmlFile->dishes->dish as $child) {

                        echo "<tr>
                        <td>" . $child->dishName . "</td>
                        <td>" . $child->dishDescription . "</td>
                        <td>" . $child->dishPrice . "</td>
                        </tr>";
                    }
                }
                ?>
            </table>
        </div>
        <div class="column ">
            <h1>Dessert menu:</h1>

            <table>
                <tr>
                    <th>Dessert Name</th>
                    <th>Dessert description</th>
                    <th>Dessert price</th>
                </tr>
                <?php
                if (file_exists("../../assets/menus/menu_dessert.xml")) {
                    $xmlFile = simplexml_load_file("../../assets/menus/menu_dessert.xml");

                    foreach ($xmlFile->desserts->dessert as $child) {

                        echo "<tr>
                        <td>" . $child->dessertName . "</td>
                        <td>" . $child->dessertDescription . "</td>
                        <td>" . $child->dessertPrice . "</td>
                        </tr>";
                    }
                } else {
                    echo "<p>Template file of how the menu would look like.</p>";
                    $xmlFile = simplexml_load_file("../../assets/templates/menu_dessert.xml");
                    foreach ($xmlFile->desserts->dessert as $child) {

                        echo "<tr>
                        <td>" . $child->dessertName . "</td>
                        <td>" . $child->dessertDescription . "</td>
                        <td>" . $child->dessertPrice . "</td>
                        </tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <div class="full">
        <h1>Reservations:</h1>
        <table>
            <tr>
                <th>Reservation ID</th>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reserved people</th>
                <th>Comments</th>
            </tr>
            <?php
            $sql = "SELECT * FROM reservations";
            $result = mysqli_query($link, $sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    $error = "No reservations found!";
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["reservationID"] . "</td>
                    <td>" . $row["userID"] . "</td>
                    <td>" . $row["firstname"] . "</td>
                    <td>" . $row["lastname"] . "</td>
                    <td>" . $row["telephone"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["time"] . "</td>
                    <td>" . $row["people"] . "</td>
                    <td>" . $row["comments"] . "</td>
                    </tr>";
                }
            } else {
                $error = "Error occurred!";
            }
            ?>
        </table>
    </div>
    <div class="full last">
        <h1>Orders:</h1>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Full Name</th>
                <th>Order</th>
            </tr>
            <?php
            $sql = "SELECT * FROM orders";
            $result = mysqli_query($link, $sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    $error = "No orders found!";
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row["orderID"] . "</td>
                    <td>" . $row["reservationFullName"] . "</td>
                    <td>" . $row["orderList"] . "</td>
                    </tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
    <p id="error">
        <?php

        echo isset($error) ? $error : "";

        ?>
    </p>

</body>

</html>