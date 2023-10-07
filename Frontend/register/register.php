<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Register</title>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 2% 5%;
        }

        .navbar-brand, .nav-link {
            font-size: 25px;
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: red; 
        }

        .card {
            color: white;
        }

        .card-header {
            font-size: 30px;
            font-weight: bold;
        }

    </style>
</head>
<body class="background-image2">
    <div class="navbar">
        <a class="navbar-brand" href="../#">Chess Connect</a>
        <a class="nav-link" href="login/login.php">Login</a>
    </div>
    <div class="container">
                 <?php
            $username = "";
            $password = "";
            $firstName ="";
            $lastName = "";
            $email = "";
            $phone = "";
            $country = "";
            $chessRating = 0;
            $favoriteOpening = "";
            $title = "";

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Get the username, password, and additional user information from the form
                $username = $_POST["username"];
                $password = $_POST["password"];
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $country = $_POST["country"];
                $chessRating = $_POST["chessRating"];
                $favoriteOpening = $_POST["favoriteOpening"];
                $title = $_POST["title"];

                // Connect to the database
                $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare a SQL statement to insert the new user
                $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);

                $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");

                // Execute the statement
                if (!mysqli_num_rows($select)&&$stmt->execute()) {
                    // Registration successful, redirect to the login page
                    header("Location: ../login/login.php");
                    exit();
                }else {
                    // Registration failed, redirect back to the registration page with an error


                echo('Sorry, the Username '.$_POST['username'].' has already been used to register.');
                $password = $_POST["password"];
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $country = $_POST["country"];
                $chessRating = $_POST["chessRating"];
                $favoriteOpening = $_POST["favoriteOpening"];
                $title = $_POST["title"];


                }

                // Close the connection
                $stmt->close();
                $conn->close();
            }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form method="POST" action="register.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>"required>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName"value="<?php echo $firstName ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"value="<?php echo $lastName ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"value="<?php echo $email ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="<?php echo $country?>">
                            </div>
                            <div class="mb-3">
                                <label for="chessRating" class="form-label">Chess Rating</label>
                                <input type="number" class="form-control" id="chessRating" name="chessRating"value="<?php echo $chessRating ?>">
                            </div>
                            <div class="mb-3">
                                <label for="favoriteOpening" class="form-label">Favorite Opening</label>
                                <input type="text" class="form-control" id="favoriteOpening" name="favoriteOpening"value="<?php echo $favoriteOpening ?>">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"value="<?php echo $title ?>">
                            </div>
                            <!-- Add fields for other user information (email, country, etc.) -->
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
