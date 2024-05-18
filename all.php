<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News</title>
    <link rel="stylesheet" href="style.css?v=<?=$version?>">
    <link rel="stylesheet" href="./css/style.css?v=<?=$version?>" />
    <style>
        /* CSS for centering only the "Add News" section */
        h1 {
            text-align: center;
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
                <button class="logout-button" onclick="logout()">Logout</button>
            </div>
        </div>
    </nav>

    <h1>All News</h1>
    <div class="all-news-container">
        <?php
        include_once "db_connection.php";

        // Fetch news data from the database
        $sql = "SELECT * FROM newss";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // <!-- Inside the while loop where you display news items -->
                echo "<div class='news-card'>";
                echo "<img src='" . $row["image"] . "' alt='News Image'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>" . $row["brief"] . "</p>";
                echo "<a href='article.php?id=" . $row["id"] . "' class='read-more-button'>Read More</a>";
                echo "</div>";

            }
        } else {
            echo "0 results";
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
    <script src="./js/script.js"></script>
    <script>
        // Function to logout
        function logout() {
            window.location.href = "http://localhost/sports/login%20system/login_form.php";
        }
    </script>

</body>
</html>