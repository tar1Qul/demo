<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }
    .navbar {
        background-color: #1abc78;
    }
    .navbar .nav-link {
        color: white !important;
        font-weight: bold;
    }
    .navbar .nav-link.active {
        color: yellow !important;
    }
    .main-banner img {
        height: 400px;
        object-fit: cover;
    }
    h2.title {
        color: #007BFF;
        font-weight: bold;
    }
    .profile-box {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .footer {
        background-color: #1abc78;
        color: white;
        padding: 10px;
        font-size: 0.9rem;
    }
    label {
        font-weight: bold;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="images/ULAB-logo.webp" alt="ULAB Logo" height="40"></a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="home_index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="terms.html">Terms</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Banner -->
<div class="main-banner text-center">
  <img src="images/ulab_picture.jpg" alt="Campus" class="img-fluid w-100">
</div>

<!-- Profile Info -->
<section class="text-center py-4">
  <h2 class="title">Welcome, <?php echo htmlspecialchars($user['student_name']); ?></h2>
  <div class="container col-md-6 text-start profile-box mt-3">
    <p><label>Student Name:</label> <?php echo htmlspecialchars($user['student_name']); ?></p>
    <p><label>Student ID:</label> <?php echo htmlspecialchars($user['student_id']); ?></p>
    <p><label>Email:</label> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><label>Mobile:</label> <?php echo htmlspecialchars($user['mobile']); ?></p>
    <p><label>Club to Join:</label> <?php echo htmlspecialchars($user['club']); ?></p>
   
  </div>
</section>

<!-- Footer -->
<footer class="footer text-center">
  <p>Developed By Prapti_222014082</p>
</footer>

</body>
</html>
