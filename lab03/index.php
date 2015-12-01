<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sukky Cars Ltd</title>
    </head>

    <body>
        <?php
            $title = "Please fill the form";
            $message = "";

            if (isset ($_COOKIE["user"])){
                thankYou();
            }
            else{
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $comment = $_POST["comment"];
                    if (validateData($name, $email, $comment)){
                        $time = time() + 60;
                        setcookie("user", $name, $time);
                        thankYou();
                    }
                    else{
                        $message = "Please fill in all fields with at least 3 characters.";
                        showTitle($title, $message);
                        showForm();
                        pageLoads();
                    }
                }
                else{
                    showTitle($title, $message);
                    showForm();
                    pageLoads();
                }
            }

            function thankYou(){
                $title = "Thank you!";
                $message = "Your comment has been recorded.";
                showTitle($title, $message);
                pageLoads();
            }

            function validateData($name, $email, $comment){
                if(strlen($name) > 2 and strlen($email) > 2 and strlen($comment) > 2){
                    return true;
                }
                else{
                    return false;
                }
            }

            function showTitle($title, $message){
                echo "<h1>".$title."</h1>";
                if ($message != null)
                    echo "<h3>".$message."</h3>";
            }

            function showForm(){
                $file = fopen("form.txt", "r") or die("Unable to open file!");
                while(!feof($file)) {
                    echo fgets($file);
                }
                fclose($file);
            }

            function pageLoads(){
                $file = fopen("PageLoads.txt", "r") or die("Unable to open file!");
                $pageLoads = fgets($file);
                fclose($file);

                $pageLoads++;

                $file = fopen("PageLoads.txt", "w") or die("Unable to open file!");
                fwrite($file, $pageLoads);
                fclose($file);

                echo ("<h5>Number of page loads: " . $pageLoads . "</h5>");
            }
        ?>
    </body>
</html>
