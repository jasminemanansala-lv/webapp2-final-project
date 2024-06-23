<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <title>Post Page</title>
    <style>
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

        .header i {
            font-size: 15px;
            margin-left: 10px;
        }

        .post-container {
            max-width: 600px;
            margin: 150px auto;
            padding: 20px;
            border: 1px solid #7768AE;
            background-color: #cfc6f1;
            border-radius: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9ff;
            cursor: pointer;
        }

        li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="posts.php">
            <h3><i class="fa-solid fa-circle-chevron-left" id="back"></i>Back to Posts Page</h3>
        </a>
    </div>
    <div class="post-container">
        <h1>Post Page</h1>
        <div id="post-content">
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
                    if (isset($_GET['id'])) {
                        $post_id = $_GET['id'];

                        $query = "SELECT * FROM `posts` WHERE id = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $post_id]);

                        $post = $statement->fetch(PDO::FETCH_ASSOC);

                        if ($post) {
                            echo '<h3>Title: ' . $post['title'] . '</h3>';
                            echo '<p>Body: ' . $post['body'] . '</p>';
                        } else {
                            echo "No post found with ID $id!";
                        }
                    } else {
                        echo "No post ID provided!";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>
</body>

</html>