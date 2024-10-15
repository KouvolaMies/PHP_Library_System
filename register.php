<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/register.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="indexBox">
            <form action="register.php" method="post">
                <div id="registerText">Register an account</div>
                <div id="registerRow">username:<input type="text" name="username" id="registerInput"></div>
                <div id="registerRow">first name:<input type="text" name="firstname" id="registerInput"></div>
                <div id="registerRow">last name:<input type="text" name="lastname" id="registerInput"></div>
                <div id="registerRow">email:<input type="text" name="email" id="registerInput"></div>
                <div id="registerRow">confirm email:<input type="text" name="conEmail" id="registerInput"></div>
                <div id="registerRow">password:<input type="text" name="password" id="registerInput"></div>
                <div id="registerRow">confirm password:<input type="text" name="conPassword" id="registerInput"></div>
                <input type="submit" id="registerSubmit" value="register">
            </form>
            <button onclick="GoToIndex()" id="indexButton">Back to Index</button>

            <?php
                error_reporting(0);
                include "db_connect.php";

                $username = $_POST["username"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $conEmail = $_POST["conEmail"];
                $password = $_POST["password"];
                $conPassword = $_POST["conPassword"];

                $memberRows = $pdo->query("SELECT username FROM users")->fetchAll();
                foreach($memberRows as $row){
                    if($username == $row["username"]){
                        echo "username is already taken";
                        return;
                    }
                }

                if(strlen($username) < 2 || strlen($username) > 25){
                    echo "<div id='errorMessage'>username needs to be between 2 and 25 characters long</div>";
                }elseif(strlen($firstname) < 2 || strlen($firstname) > 50){
                    echo "<div id='errorMessage'>firstname needs to be between 2 and 50 characters</div>";
                }elseif(strlen($lastname) < 2 || strlen($lastname) > 50){
                    echo "<div id='errorMessage'>lastname needs to be between 2 and 50 characters</div>";
                }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "<div id='errorMessage'>invalid email adress</div>";
                }elseif($conEmail != $email){
                    echo "<div id='errorMessage'>email and confirm email do not match</div>";
                }elseif(strlen($password) < 4 || strlen($password) > 16){
                    echo "<div id='errorMessage'>password must be between 4 and 16 characters</div>";
                }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
                    echo "<div id='errorMessage'>password can only contain letters and numbers</div>";
                }elseif($conPassword != $password){
                    echo "<div id='errorMessage'>passwords don't match</div>";
                }else{
                    $row = [
                        "username" => $username,
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "email" => $email,
                        "passwd" => password_hash($password, PASSWORD_DEFAULT),
                        "creationdate" => date("Y-m-d")
                    ];
        
                    $sql = "INSERT INTO users SET username=:username, firstname=:firstname, lastname=:lastname, email=:email, passwd=:passwd, creationdate=:creationdate;";
                    $status = $pdo->prepare($sql)->execute($row);
        
                    if ($status) {
                        $userId = (int)$pdo->lastInsertId();
                    }
                }
            ?>
        </div>
    </body>
</html>