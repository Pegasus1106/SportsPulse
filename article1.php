<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Article</title>
    <style>
        /* Add any necessary styles for article page */
        .article-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .article {
            margin-bottom: 30px;
        }

        .article img {
            max-width: 100%;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .article h2 {
            margin-top: 0;
        }

        .article p {
            margin-bottom: 0;
        }

        .edit-button, .delete-button {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            background-color: rgb(240, 37, 37);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
<nav>
        <div class="container">
            <div class="logo" onclick="redirectToHomePage()">
                <h1>Sport<span>Pulse</span></h1>
            </div>
            <script>
                function redirectToHomePage() {
                    window.location.href = "./index.html";
                }
            </script>
            <div class="options">
                <a href="./index.html">Home</a>
                <a href="./html/about.html">About</a>
                <a href="./html/kabaddi.html">Kabaddi</a>
                <a href="./html/ipl.html">IPL</a>
                <a href="./html/about.html">Badminton</a>
                <div class="dropdown">
                    <a href="#" class="dropbtn">More</a>
                    <div class="dropdown-content">
                        <a href="./html/olympics.html">Olympics</a>
                        <a href="./html/athletics.html">Athletics</a>
                    </div>
                </div>
            </div>

            <div class="auth-buttons">
                <button class="login-button" onclick="redirectToLogin()">Login</button>
                <button class="signup-button" onclick="redirectToSignup()">Sign Up</button>
            </div>
        </div>
    </nav>
    <div class="article-container">
        <?php
        include_once "db_connection.php";
        
        // Fetch article details based on ID from URL
        $article_id = $_GET['id'];
        $sql = "SELECT * FROM newss WHERE id = $article_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            

            echo "<div class='article'>";
            echo "<img src='" . $row["image"] . "' alt='Article Image'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>" . $row["brief"] . "</p>";
            echo "<p>" . $row["description"] . "</p>";
            echo "</div>";
        } else {
            echo "Article not found.";
        }
        $conn->close();
        ?>
    </div>
    <footer>
        <div class="container">
            <div class="footer">
                <article>
                    <div class="logo">
                        <h2>Sports<span>Pulse</span></h2>
                    </div>
                    <p>
                        SportsPulse is a dynamic sports news website that offers comprehensive coverage of all the latest happenings in the world of sports. Whether you're looking for scores, highlights, trade rumors, or expert commentary, SportsPulse delivers it all with speed, accuracy, and a passion for the game. Stay ahead of the game with SportsPulse.



                    </p>
                </article>

                <article>
                    <h4>EMAIL NEWSLETTER</h4>
                    <p>Subscribe to our weekly newsletter and stay up to date with each latest updates in Sports.</p>
                    <form action="submit_email.php" method="post">
                        <input type="email" id="email" name="email" required>
                        <button class="subscribe-button" type="submit">Subscribe</button>
                    </form>
                </article>
            </div>
        </div>
    </footer>
</body>
</html>
