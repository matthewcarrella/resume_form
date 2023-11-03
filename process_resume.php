<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Resume Form</title>
</head>
<body>
  <?php
//Connect to database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "applications";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 // end connect to database
 // Assign form input to variables 
   
    $firstName = $_POST['fName'];
	$lastName = $_POST['lName'];
	$tel = $_POST['tel'];
    $email = $_POST['email'];
    $fileName =$_FILES["fileToUpload"]["name"];
    $fileTmp = $_FILES['fileToUpload']['tmp_name'];

 // end assign form input to variables
 // save data to database
    move_uploaded_file($fileTmp, "./pdf/".$fileName);
    $insertquery = "INSERT INTO applicants(firstName, lastName, tel, email, resume) VALUES('$firstName', '$lastName', '$tel', '$email', '$fileName')";
    $iquery = mysqli_query($conn, $insertquery);

  // end save data to database
  // generate email to send to admin
     $subject = "Application received";
     $message = "An application from $firstName $lastName has been received";
     $headers = "";
     mail("admin@example.com", $subject, $message, $headers);

    echo "<p>Thank you, $firstName, your information has been received!</p>";
    ?>
<body>

</body>
</html>