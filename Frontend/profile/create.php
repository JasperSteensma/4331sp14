<?php
    session_start();
 //echo $_GET['cname'];
//echo $_GET['cemail'];
//echo $_GET['cphone'];
//echo $_GET['ccountry'];
//echo $_GET['cchessRating'];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if (!isset($_SESSION['user_id'])) {
            die("User ID not found in session. Please log in again.");
        }
        
        echo "hi";
        // Assuming you pass user_id from some other source like session
        $userId = $_SESSION['user_id'];
        $name = $_GET['name'];
        $email = $_GET['email'] ?? null;  // Uses null coalescing for optional fields
        $phone = $_GET['phone'] ?? null;
        $country = $_GET['country'] ?? null;
        $chessRating = $_GET['chessRating'] ?? null;
        $favoriteOpening = $_GET['favoriteOpening'] ?? null;
        $title = $_GET['title'] ?? null;
   
        $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $userId, $name,  $phone, $country, $chessRating, $favoriteOpening, $title);*/
        $stmt->execute();
        header("Location: ../profile/");
    }


?>
