<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = htmlspecialchars($_POST['email']);
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$phonenumber = $_POST['phonenumber'];
$gender = $_POST['gender'];
$country = $_POST['country'];
saveToFile($firstname, $lastname, $email, $password, $confirmpassword, $phonenumber, $gender, $country);
saveToDatabase($firstname, $lastname, $email, $password, $confirmpassword, $phonenumber, $gender, $country);
header('Location:success.html');

function saveToFile($firstname, $lastname, $email, $password, $confirmpassword, $phonenumber, $gender, $country){
$fileHandler = fopen('record.txt', 'a');
$string = $firstname . "\n". $lastname . "\n" . $email . "\n" . $phonenumber . "\n" . $gender . "\n". $country . "\n\n";
fwrite($fileHandler, $string);
fclose($fileHandler);
}

function saveToDatabase($firstname, $lastname, $email, $password, $confirmpassword, $phonenumber, $gender, $country){
    $serverName = "localhost";
$database = "registration";
$username = "root";
$pass_word = "mysql";
//Open database connection
$conn = mysqli_connect($serverName, $username, $pass_word, $database);
// Check that connection exists
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO signup (firstname, lastname, email, password, confirmpassword, phonenumber, gender, country, created_at)
VALUES ('$firstname', '$lastname', '$email', '$password', '$confirmpassword', '$phonenumber', '$gender', '$country', NOW())";
$result = mysqli_query($conn, $sql);
//Check for errors
if (!$result) {
die("Error: " . $sql . "<br>" . mysqli_error($conn));
}
//Close the connection
mysqli_close($conn);
}

?>