<?php
session_start();

require("./config/config.php");
$error = "";
$fullname = $_SESSION["fullName"];
$sql = "SELECT * FROM orders WHERE reservationFullName = '$fullname'";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["ordered"] = false;
    } else {
        $_SESSION["ordered"] = true;
        $error = "You have already ordered!";
    }

}

if (isset($_POST["completeOrder"]) && $_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["ordered"] == false) {
    if (isset($_POST["order"]) && is_array($_POST["order"])) {
        $orderList = implode(', ', $_POST["order"]);
        $lastID = isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : "";
        $sql = "INSERT INTO orders VALUES ('default', '$lastID', '$orderList')";
        if (mysqli_query($link, $sql)) {
            $success = "Order made successfully!";
            $_SESSION["ordered"] = true;
            header("Location: ./user/userpanel.php?ordered=true");
        } else {
            $error = "Error occurred!" . mysqli_error($link);
            $_SESSION["ordered"] = false;
        }
    }
}

if (isset($_POST["cancelBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteSQL = "DELETE FROM orders WHERE reservationFullName = '$fullname'";
    if (mysqli_query($link, $deleteSQL)) {
        $success = "Deleted order successfully.";
        $_SESSION["ordered"] = false;
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
    <title>Menu</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            overflow: hidden;
            margin-top: 50px;
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


        .btn {
            text-align: center;
            background-color: #0096FF;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .cancel {
            float: right;
            background-color: red;
            color: white;
            padding: 16px 20px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
            opacity: 0.8;
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
    <?php include "./view/header.php";
    sendNavBar("menu");
    ?>
    <form action="./menu.php" method="POST">
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
                    if (file_exists("../assets/menus/menu_main.xml")) {
                        $xmlFile = simplexml_load_file("../assets/menus/menu_main.xml");
                        if (isset($_SESSION["reserved"]) && $_SESSION["reserved"] == true && isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && isset($_SESSION["ordered"]) && $_SESSION["ordered"] == false) {
                            foreach ($xmlFile->dishes->dish as $child) {
                                $check = "<input type='checkbox' name='order[]' value=" . $child->dishName . "></input>";
                                echo "<tr>
                            <td>" . $child->dishName . "</td>
                            <td>" . $child->dishDescription . "</td>
                            <td>" . $child->dishPrice . "</td>                        
                            <td>" . $check . "</td>                        
                            </tr>";
                            }

                        } else {
                            foreach ($xmlFile->dishes->dish as $child) {

                                echo "<tr>
                        <td>" . $child->dishName . "</td>
                        <td>" . $child->dishDescription . "</td>
                        <td>" . $child->dishPrice . "</td>                        
                        </tr>";
                            }
                        }
                    } else {
                        echo "<h1 style='color: red;'> No menu was found! Contact an administrator.</h1>";
                    }
                    ?>
                </table>
            </div>
            <div class="column">
                <h1>Dessert menu:</h1>

                <table>
                    <tr>
                        <th>Dessert Name</th>
                        <th>Dessert description</th>
                        <th>Dessert price</th>
                    </tr>
                    <?php
                    if (file_exists("../assets/menus/menu_dessert.xml")) {
                        $xmlFile = simplexml_load_file("../assets/menus/menu_dessert.xml");

                        if (isset($_SESSION["reserved"]) && $_SESSION["reserved"] == true && isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && isset($_SESSION["ordered"]) && $_SESSION["ordered"] == false) {
                            foreach ($xmlFile->desserts->dessert as $child) {
                                $check = "<input type='checkbox' name='order[]' value=" . $child->dessertName . "></input>";
                                echo "<tr>
                            <td>" . $child->dessertName . "</td>
                            <td>" . $child->dessertDescription . "</td>
                            <td>" . $child->dessertPrice . "</td>                        
                            <td>" . $check . "</td>                        
                            </tr>";
                            }

                        } else {
                            foreach ($xmlFile->desserts->dessert as $child) {

                                echo "<tr>
                        <td>" . $child->dessertName . "</td>
                        <td>" . $child->dessertDescription . "</td>
                        <td>" . $child->dessertPrice . "</td>
                        </tr>";
                            }
                        }
                    } else {
                        echo "<h1 style='color: red;'> No menu was found! Contact an administrator.</h1>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php if (isset($_SESSION["reserved"]) && $_SESSION["reserved"] == true && isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && isset($_SESSION["ordered"]) && $_SESSION["ordered"] == false) {
            $button = "<button class='btn centered' name='completeOrder'>Complete order</button>";
            echo $button;
        } else {
        }
        ?>
        <p id="error">
            <?php
            echo isset($error) ? $error : "";
            ?>
        </p>
        <?php if (isset($_SESSION["reserved"]) && $_SESSION["reserved"] == true && isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && isset($_SESSION["ordered"]) && $_SESSION["ordered"] == true) {
            $button = "<button name='cancelBtn' class='cancel'>Cancel order </button>";
            echo $button;
        }
        ?>
    </form>

</body>

</html>