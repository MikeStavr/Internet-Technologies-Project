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

                    foreach ($xmlFile->dishes->dish as $child) {

                        echo "<tr>
                        <td>" . $child->dishName . "</td>
                        <td>" . $child->dishDescription . "</td>
                        <td>" . $child->dishPrice . "</td>
                        </tr>";
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

                    foreach ($xmlFile->desserts->dessert as $child) {

                        echo "<tr>
                        <td>" . $child->dessertName . "</td>
                        <td>" . $child->dessertDescription . "</td>
                        <td>" . $child->dessertPrice . "</td>
                        </tr>";
                    }
                } else {
                    echo "<h1 style='color: red;'> No menu was found! Contact an administrator.</h1>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>