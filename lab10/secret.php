<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sukky Cars Ltd - Secret Page</title>
    </head>

    <body>
        <?php
            session_start();
            session_regenerate_id(true);

            if (isset ($_SESSION["logged"])) {
                echo "<h1>Welcome to the hidden pages, " . $_SESSION["logged_user"] . "</h1>";
                echo "<a href='?page=1'>First hidden page<a> | ".
                     "<a href='?page=2'>Second hidden page<a> | ".
                     "<a href='?page=3'>Third hidden page<a> ".
                     "<hr/>";
                $page = isset($_GET['page']) ? trim($_GET['page']) : 'default';
                $logout = isset($_GET['logout']) ? trim($_GET['logout']) : false;

                if ($logout) {
                    unset($_SESSION["logged"]);
                    unset($_SESSION["logged_user"]);
                    session_destroy();
                    header('Location: ./');
                }

                if ($page == 1) {
                    echo "<p>This is the very first hidden page.<br/>only logged in users can access this.</p>";
                } else if ($page == 2) {
                    echo "<p>Only logged in users can access this one.</p>";
                } else if ($page == 3) {
                    echo "<p>This one is almost empty..</p>";
                }
            }
            else{
                header('Location: ./');
            }
        ?>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <hr/>
        <a href="?logout=true">Logout here</a>
    </body>
</html>
