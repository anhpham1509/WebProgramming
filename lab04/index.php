<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sukky Cars Ltd</title>
    </head>

    <body>
        <?php
            session_start();

            $guide = "Log in to see all the secrets";
            $message = "";

            if (isset ($_SESSION["logged"])){
                secretPage();
            }
            else {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    if ($username === "admin" and $password === "admin") {
                        $_SESSION["logged"] = true;
                        secretPage();
                    }
                    else {
                        if ($username != null and $password != null){
                            $message = "Incorrect. Please try again";
                            showTitle($guide, $message);
                            showForm();
                        }
                        else{
                            header('Location: ./');
                        }
                    }
                }
                else {
                    showTitle($guide, $message);
                    showForm();
                }
            }

            function secretPage(){
                $guide = "";
                $message = "";
                $content = "";

                $page = isset($_GET['page']) ? trim($_GET['page']) : 'default';
                $logout = isset($_GET['logout']) ? trim($_GET['logout']) : false;
                if ($logout){
                    unset($_SESSION["logged"]);
                    session_destroy();
                    header('Location: ./');
                }

                if ($page == 1){
                    $content = "This is the very first hidden page.<br/>only logged in users can access this.";
                }
                else if ($page == 2){
                    $content = "Only logged in users can access this one.";
                }
                else if ($page == 3){
                    $content = "This one is almost empty..";
                }
                else if ($page == 'default'){
                    $guide = "Correct! Welcome to the hidden pages";
                    $content = "";
                }
                showTitle($guide, $message);
                showHiddenPages($content);
            }

            function showHiddenPages($content){
                $showed = false;

                $file = fopen("hidden.txt", "r") or die("Unable to open file!");
                while (!feof($file)) {
                    $line = fgets($file);
                    echo $line;
                    if (!$showed and $content != "" and $line == "<hr/>\n"){
                        $showed = true;
                        echo "<p>" . $content . "</p>";
                    }
                }
                fclose($file);
            }

            function showTitle($guide, $message)
            {
                echo "<h1>Welcome to the website</h1>";
                if ($guide != null)
                    echo "<h3>" . $guide . "</h3>";
                if ($message != null)
                    echo "<h5>" . $message . "</h5>";
            }

            function showForm()
            {
                $file = fopen("form.txt", "r") or die("Unable to open file!");
                while (!feof($file)) {
                    echo fgets($file);
                }
                fclose($file);
            }

        ?>

    </body>
</html>