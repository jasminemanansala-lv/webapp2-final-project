<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <title>Posts Page</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header #back {
            padding-right: 10px;
        }

        .header h3 {
            font-size: 15px;
        }

        .header a {
            text-decoration: none;
            color: #34295c;
        }

        .posts-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }


        .sub-title {
            font-size: 60px;
            font-weight: 600;
            color: #423964;
        }

        #services {
            padding: 30px 0;
            margin: 0 30px;
        }

        .services-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 40px;
            margin-top: 30px;
            list-style-type: none;
        }

        .services-list div {
            background: #262626;
            padding: 40px;
            font-size: 13px;
            font-weight: 300;
            border-radius: 10px;
            padding: 2em 1em 2em 1em;
            background: #7768AE;
            color: #fafafa !important;
        }

        .services-list div i {
            font-size: 30px;
            margin-left: 10px;
        }

        .services-list div h2 {
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .li-design {
            font-size: 13px;
            font-weight: 300;
            border-radius: 10px;
            transition: background 0.5s, transform 0.5s;
            padding: 3em 2em 2em 3em;
            background: #7768AE;
            border: 1px solid #ebebeb;
            color: #fafafa !important;
            box-shadow: rgba(0, 0, 0, 0.14902) 0px 1px 1px 0px, rgba(0, 0, 0, 0.09804) 0px 1px 2px 0px;
        }

        .li-design:hover {
            transform: translateY(-10px);
        }

        .link-hover:hover {
            background-color: #c6bee9;
        }
    </style>
</head>

<body>
    <div id="services">
        <div class="container">
            <div class="header">
                <h1 class="sub-title">Posts Page</h1>
                <a href="index.php">
                    <h3><i class="fa-solid fa-right-from-bracket" id="back"></i>Log Out</h3>
                </a>
            </div>

            <div class="services-list"> <!-- START PHP CODING HERE //postLists -->

                <?php

                require 'config.php';

                if (!isset($_SESSION['id'])) {
                    header("Location: index.php");
                    exit;
                }

                $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";
                $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

                try {
                    $pdo = new PDO($dsn, $db_username, $db_password, $options);

                    if ($pdo) {
                        $user_id = $_SESSION['id'];

                        $query = "SELECT * FROM `posts` WHERE userId = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $user_id]);


                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            echo '<li class="li-design">
                            <h2 style="color: #fafafa; padding: 0 0 20px 0; font-size: 35px;">
                                <i class="fa-solid fa-scroll" style="color: #fafafa; padding: 0 20px 0 0;"></i> Posts
                            </h2>
                            <div class="link-hover">
                            <a style="text-decoration:none; color: #fafafa;" 
                            href="post.php?id=' . $row['id'] . '">' . $row['title'] . "</div>" . '</li>';
                        }
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>