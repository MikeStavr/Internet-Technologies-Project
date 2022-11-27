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

        * {
            overflow: hidden;
        }

        .container {
            padding: 16px;
        }

        form {
            margin-top: 50px;
        }

        /* Button used to open the contact form - fixed at the bottom of the page */
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

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=email],
        .form-container input[type=tel],
        .form-container input[type=date],
        .form-container input[type=time] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=email]:focus,
        .form-container input[type=tel]:focus,
        .form-container input[type=date]:focus,
        .form-container input[type=time]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
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

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
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
            </span>
        </h2>
    </div>
    <div class="top-right">
        <button class="open-button" onclick="openForm()">Open Form</button>
        <div class="form-popup" id="myForm">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">

                <label for="firstname"><b>First name</b></label>
                <input type="text" name="firstname" id="firstname"
                    value="<?php echo isset($_SESSION["firstName"]) ? $_SESSION["firstName"] : '' ?>"
                    placeholder="Enter your first name." required>

                <label for="lastname"><b>Last name</b></label>
                <input type="text" name="lastname" id="lastname"
                    value="<?php echo isset($_SESSION["lastName"]) ? $_SESSION["lastName"] : '' ?>"
                    placeholder=" Enter your last name." required>

                <label for="telephone"><b>Telephone</b></label>
                <input type="tel" name="telephone" id="telephone"
                    value="<?php echo isset($_SESSION["telephone"]) ? $_SESSION["telephone"] : '' ?>"
                    placeholder="Enter your phone number." required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter your email."
                    value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : '' ?>" name="email" id="email"
                    required>

                <label for="email"><b>Reservation date</b></label>
                <input type="date" name="email" id="email" required>

                <label for="email"><b>Reservation time</b></label>
                <select>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

                <button type="submit" class="btn" name="submit">Submit</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
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
    </table>

    <script type="text/javascript">
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        } </script>
</body>

</html>