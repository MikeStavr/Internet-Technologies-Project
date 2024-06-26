<style>
    .topnav {
        background-color: #282828;
        overflow: hidden;
        position: fixed;
        top: 0;
        width: 100%;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #0096FF;
        color: white;
    }

    .topnav .right {
        float: right;
    }
</style>

<?php

function sendNavBar($active)
{
    switch ($active) {
        case "login":
            echo " <div class='topnav'>
                            <a href='./index.php' title='Go back to the homepage.'>Home</a>
                            <a class='active' href='./login.php' title='Login to view your reservations'>Login</a>
                            <a href='./menu.php' title='View the menu.'>Menu</a>
                            </div>";
            break;

        case "home":
            echo " <div class='topnav'>
                            <a class='active' href='./index.php' title='Go back to the homepage.'>Home</a>
                            <a href='./login.php' title='Login to view your reservations'>Login</a>
                            <a href='./menu.php' title='View the menu.'>Menu</a>
                            <a href='./admin.php' class='right' title='Login to the admin panel.'>Admin</a>
                            <a href='./register.php' class='right' title='Register to the website.'>Register</a>
                            </div>";
            break;

        case "menu":
            echo " <div class='topnav'>
                            <a href='./index.php' title='Go back to the homepage.'>Home</a>
                            <a href='./login.php' title='Login to view your reservations'>Login</a>
                            <a class='active' href='./menu.php' title='View the menu.'>Menu</a>
                            <a href='./admin.php' class='right' title='Login to the admin panel.'>Admin</a>
                            </div>";
            break;

        case "admin":
            echo " <div class='topnav'>
                            <a href='./index.php' title='Go back to the homepage.'>Home</a>
                            <a href='./login.php' title='Login to view your reservations' >Login</a>
                            <a href='./menu.php'  title='View the menu.'>Menu</a>
                            <a href='./admin.php' class='right active' title='Go to the admin panel.'>Admin</a>
                            </div>";
            break;
        case "register":
            echo " <div class='topnav'>
                                <a href='./index.php' title='Go back to the homepage.'>Home</a>
                                <a href='./login.php' title='Login to view your reservations' >Login</a>
                                <a href='./menu.php'  title='View the menu.'>Menu</a>
                                <a href='./register.php' class='active right' title='View the menu.'>Register</a>
                                </div>";
            break;
        case "adminPanel":
            echo " <div class='topnav'>
                                    <a href='../index.php' title='Go back to the homepage.'>Home</a>
                                    <a href='../login.php' title='Login to view your reservations' >Login</a>
                                    <a href='../menu.php'  title='View the menu.'>Menu</a>
                                    <a href='../logout.php' class='active right' title='Logout.'>Logout</a>
                                    </div>";
            break;
        case "userPanel":
            echo " <div class='topnav'>
                                        <a href='../index.php' title='Go back to the homepage.'>Home</a>
                                        <a href='../login.php' title='Login to view your reservations' >Login</a>
                                        <a href='../menu.php'  title='View the menu.'>Menu</a>
                                        <a href='../logout.php' class='active right' title='Logout.'>Logout</a>
                                        </div>";
            break;
        default:
            echo " <div class='topnav'>
            <a href='./index.php' title='Go back to the homepage.'>Home</a>
            <a  href='./login.php' title='Login to view your reservations'>Login</a>
            <a href='./menu.php' title='View the menu.'>Menu</a>
            <a href='./admin.php' class='right' title='Login to the admin panel.'>Admin</a>
            </div>";

            break;
    }
}

?>