<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sukky Cars Ltd</title>
    </head>

    <body>
        <h1>Welcome to the website</h1>
        <h3>Log in to see all the secrets</h3>

        <?php
            session_start();

            session_regenerate_id(true);

            if (isset ($_SESSION["logged"])) {
                header('Location: secret.php');
            }
            else {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    if (checkLogin($username, $password)) {
                        $_SESSION["logged"] = true;
                        header('Location: secret.php');
                    } else {
                        if (!($username != null and $password != null)) {
                            header('Location: ./');
                        }
                    }
                }
            }

            function checkLogin($username, $password){
                $database = mysqli_connect("mysql.metropolia.fi", "duyp", "DuyAnh1509", "duyp");
                if (!$database) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $username = mysqli_real_escape_string ($database, $username);
                $password = mysqli_real_escape_string ($database, $password);

                $query = "SELECT *  FROM users WHERE username = '$username'";
                $result = mysqli_query($database, $query);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $hash = $row["passwordHash"];
                        if (password_verify($password, $hash)){
                            $_SESSION["logged_user"] = $row["fullname"];
                            mysqli_close($database);
                            return true;
                        }
                        else{
                            mysqli_close($database);
                            echo "<h5>Password is not valid!</h5>";
                            return false;
                        }
                    }
                } else {
                    echo "<h5>Username is not valid!</h5>";
                    mysqli_close($database);
                    return false;
                }
            }
        ?>
        <form method="POST" action="index.php">
            <div>
                <label for='username'>Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username"/>
            </div>

            <div>
                <label for='password'>Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password"/>
            </div>

            <input type="submit" value="Log in">
        </form>

        <p><a href="register.php">Don't Have an Account? Register here!</a></p>
    </body>
</html>
