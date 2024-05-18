<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <!-- Add any necessary stylesheets or scripts here -->
    <link rel="stylesheet" href="./css/style.css" />
    <style>
        /* CSS for form styling */
        /* Add News Form */
        .red-theme-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000000;
            border-radius: 5px;
        }

        .red-theme-form label {
            display: block;
            margin-bottom: 5px;
            color: #000000;
        }

        .red-theme-form input[type="text"],
        .red-theme-form textarea {
            width: calc(100% - 16px); /* Adjust for input padding and border */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #000000;
            border-radius: 4px;
        }

        .red-theme-form textarea {
            height: 100px;
        }

        /* Adjust position of submit button */
        .submit-button-wrapper {
            text-align: center; /* Align button to center */
            padding-top: 20px; /* Add padding */
        }

        .red-theme-submit-button {
            background-color: #e74c3c; /* Red button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .red-theme-submit-button:hover {
            background-color: #c0392b; /* Darker red on hover */
        }

        /* Center the submit button */
        .red-theme-form div {
            text-align: center;
            padding: 10px 20px;
        }

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
    <h1><strong>Edit Article</strong></h1>
    <?php
    include_once "db_connection.php";

    // Fetch article details based on ID from URL
    if(isset($_GET['id'])) {
        $article_id = $_GET['id'];
        $sql = "SELECT * FROM newss WHERE id = $article_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form id="editForm" class="red-theme-form" action="edit_news.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo isset($row['title']) ? htmlspecialchars_decode($row['title']) : ''; ?>" required><br>

        <label for="brief">Brief:</label>
        <textarea id="brief" name="brief" rows="2" required><?php echo isset($row['brief']) ? htmlspecialchars_decode($row['brief']) : ''; ?></textarea><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo isset($row['description']) ? htmlspecialchars_decode($row['description']) : ''; ?></textarea><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>
        <div>
        <button type="submit" class="red-theme-submit-button">Save Changes</button>
        </div>
    </form>
    <?php
        } else {
            echo "Article not found.";
        }
    } else {
        echo "Article ID not provided.";
    }
    $conn->close();
    ?>

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
