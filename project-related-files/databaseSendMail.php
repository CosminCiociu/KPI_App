<?php

$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USER_DB'];
$password = $_ENV['PASSWORD_DB'];
$dbname = $_ENV['NAME_DB'];
$emailReceiver = $_ENV['EMAIL_RECEIVER'];
$senderEmail = $_ENV['EMAIL_SENDER'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Clients (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
company VARCHAR(30),
country VARCHAR(30),
prefix VARCHAR(4),
phoneNumber VARCHAR(30),
email VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
} else {
    // echo "Error creating table: " . $conn->error;
}
$conn->close();

// echo "Table MyGuests created successfully";
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['email'])) {
    $link = mysqli_connect("localhost", "Cosmin", "welcome01", "test");
    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $first_name = mysqli_real_escape_string($link, $_REQUEST['fname']);
    $last_name = mysqli_real_escape_string($link, $_REQUEST['lname']);
    $company = mysqli_real_escape_string($link, $_REQUEST['company']);
    $country = mysqli_real_escape_string($link, $_REQUEST['country']);
    $prefix = mysqli_real_escape_string($link, $_REQUEST['prefix']);
    $phoneNumber = mysqli_real_escape_string($link, $_REQUEST['phone']);
    $email = mysqli_real_escape_string($link, $_REQUEST['email']);


    $sql = "INSERT INTO Clients (firstname, lastname, company, country, prefix, phoneNumber, email)
    VALUES ('$first_name', '$last_name','$company','$country','$prefix','$phoneNumber', '$email')";

    if (mysqli_query($link, $sql)) {
        echo "Records added successfully.<br>";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);

    // Sending email
    // the message
    $msg = "Data Inserted in table: '$first_name', '$last_name', '$company' , '$country', '$prefix', '$phoneNumber', '$email'";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail($emailReceiver, "Test", $msg, "From:" . $senderEmail);
    echo "Mail sent successfully to $emailReceiver";
}
