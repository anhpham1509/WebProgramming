<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sukky Cars Ltd</title>
    </head>

    <body>
        <h1>Register new account here..</h1>
        <?php
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $tel = $_POST["tel"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $passwordAgain = $_POST["password-again"];


                if ($name != "" &&
                    $email != "" &&
                    $tel != "" &&
                    $username != "" &&
                    $password != "" &&
                    $passwordAgain != "") {

                    $database = mysqli_connect("mysql.metropolia.fi", "duyp", "DuyAnh1509", "duyp");

                    $usernameValid = checkUsername($database, $username);
                    $emailValid = checkEmail($database, $email);
                    $passwordsValid = checkPasswords($password, $passwordAgain);

                    if ($usernameValid && $emailValid && $passwordsValid) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (fullname, email, tel, username, passwordHash, timeAdded) " .
                            "VALUES ('$name', '$email', '$tel', '$username', '$hash', NOW())";
                        if (mysqli_query($database, $sql)) {
                            header('Location: ./');
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($database);
                        }
                    }
                }
                else{
                    echo "<h5>Please fill in all the fields!</h5>";
                }
            }

            function checkUsername($database, $username){
                $query = "SELECT *  FROM users WHERE username = '$username'";
                $result = mysqli_query($database, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "<h5>Username <i>$username</i> has been used, please use different username!</h5>";
                    return false;
                }

                return true;
            }

            function checkEmail($database, $email){
                $query = "SELECT *  FROM users WHERE email = '$email'";
                $result = mysqli_query($database, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "<h5>Email <i>$email</i> has been used, please use different email!</h5>";
                    return false;
                }

                return true;
            }

            function checkPasswords($pass1, $pass2){
                if ($pass1 !== $pass2){
                    echo "<h5>Password does not match!!</h5>";
                    return false;
                }

                return true;
            }

        ?>
        <form action="register.php" method="POST">
            <div>
                <label for="name">Full name:</label>
                <input type="text" class="input" name="name" id="name" placeholder="Enter full name" autofocus/>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" class="input" name="email" id="email" placeholder="Enter email"/>
            </div>

            <div>
                <label for="tel">Tel:</label>
                <input type="text" class="input" name="tel" id="tel" placeholder="Enter telephone number"/>
            </div>

            <div>
                <label for="username">Username:</label>
                <input type="text" class="input" name="username" id="username" placeholder="Enter username"/>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" class="input" name="password" id="password" placeholder="Enter password"/>
            </div>

            <div>
                <label for="password-again">Retype Password:</label>
                <input type="password" class="input" name="password-again" id="password-again"
                       placeholder="Enter password again"/>
            </div>

            <input type="submit" class="submit" value="Submit">
        </form>

        <p><a href="./">Back to Login site</a></p>
    </body>
</html>
