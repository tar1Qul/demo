<?php
session_start();
$conn = new mysqli("localhost", "root", "", "students");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['student_name'];
$id = $_POST['student_id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$club = $_POST['club'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO club_members (student_name, student_id, email, mobile, club, password)
        VALUES ('$name', '$id', '$email', '$mobile', '$club', '$password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['student_id'] = $id;
    header("Location: profile.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
