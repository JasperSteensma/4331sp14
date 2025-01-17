<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

error_reporting(E_ALL); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

    $inData=getRequestInfo();
    $username=$inData[0];
    
    $password=$inData[1];
     $firstName=$inData[2];
    $lastName=$inData[3];
     $email=$inData[4];
    $phone=$inData[5];
     $country=$inData[6];
    $chessRating=$inData[7];
     $favoriteOpening=$inData[8];
    $title=$inData[9];
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

               
               

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$inData[0]."'");

    if(mysqli_num_rows($result)>0){
        die();
    }
    
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  
    $stmt->bind_param("ssssssssss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
 if($stmt->execute()){
    
       header("Location:https://chessconnect.xyz/login/login.php");
        exit();
 }
 $stmt->close();
   $conn->close();
    	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>
