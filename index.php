<?php
require 'config.php';

$dsn = "mysql:host=$db_host; dbname=$db_name; charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $db_username, $db_password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $username = $_POST['login_username'];
            $password = $_POST['login_password'];

            $query = "SELECT * FROM `users` WHERE username = :login_username";
            $statement = $pdo->prepare($query);
            $statement->execute([':login_username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('secret1234' === $password) {
                    // echo "<pre>";
                    // print_r($user);
                    // echo "</pre>";
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['name'] = $user['name'];

                    header('Location: posts.php');
                    exit;
                } else {
                    echo '<script type="text/JavaScript">  
                    alert("Incorrect Password"); 
                    </script>';
                }
            } else {
                echo '<script type="text/JavaScript">  
                    alert("User not found!"); 
                    </script>';
            }
        }

    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins);

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: "Poppins", sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;


            /* max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px; */
        }

        .heading-content {
            text-align: center;
            margin-bottom: 40px;
            padding: 0px;
        }

        .heading-content>* {
            margin: 0px;
            padding: 5px;
        }

        #loginForm {
            width: 380px;
            border-radius: 4px;
            margin: 2em auto;
            padding: 3em 2em 2em 3em;
            background: #fafafa;
            border: 1px solid #ebebeb;
            color: black !important;
            box-shadow: rgba(0, 0, 0, 0.14902) 0px 1px 1px 0px, rgba(0, 0, 0, 0.09804) 0px 1px 2px 0px;
        }

        .login {
            margin-bottom: 30px;
        }

        .login-content {
            font-size: 18px;
            width: 100%;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            border: 2px solid #7768AE;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            padding: 12px;
        }

        .btn {
            width: 100%;
            padding: 10px 0px;
            background: #7768AE;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            color: #fff;
            border: none;
            font-weight: 600;
        }


        /* .login-container h2{
            text-align: center;
        } */

        /* input[type="text"], input[type="password"], button {
            display: block;
            margin-bottom: 10px;
            margin-left: 210px;
        } */

        /* #loginForm button{
            margin-left: 275px;
        } */
    </style>
</head>

<body>
    <div class="login-container">
        <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="heading-content">
                <h2>Welcome!</h2>
                <p>Please enter your login detail.</p>
            </div>
            <div class="login login-content">
                <input type="text" id="username" placeholder="Enter username" name="login_username" required>
            </div>
            <div class="login login-content">
                <input type="password" id="password" placeholder="Enter password" name="login_password" required>
            </div>
            <div class="login login-button">
                <button class="btn" id="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>