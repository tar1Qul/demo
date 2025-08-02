<?php
session_start();
$conn = new mysqli("localhost", "root", "", "students");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user by email
    $sql = "SELECT * FROM club_members WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            // Log the login
            $user_id = $user['id']; // make sure 'id' is the correct column
            $log_sql = "INSERT INTO login_members (user_id, email) VALUES ('$user_id', '$email')";
            mysqli_query($conn, $log_sql);

            header("Location: profile.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No user found with that email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ULAB Club Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .custom-navbar {
            background-color: #1abc78;
            padding: 10px 0;
        }

        .custom-navbar .nav-link {
            color: white !important;
            font-weight: bold;
            margin-left: 15px;
        }

        .custom-navbar .nav-link.active {
            color: yellow !important;
        }

        .main-banner img {
            height: 400px;
            object-fit: cover;
        }

        h2.form-title {
            font-weight: bold;
            color: blue;
        }

        .footer {
            background-color: #1abc78;
            color: white;
            padding: 10px;
            font-size: 0.9rem;
        }

        .error-msg {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="images/ULAB-logo.webp" alt="ULAB Logo" height="40"></a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="home_index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="terms.html">Terms</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Banner -->
<div class="main-banner text-center">
    <img src="images/ulab_picture.jpg" alt="Campus" class="img-fluid w-100">
</div>

<!-- Login Form -->
<section class="text-center py-4">
    <h2 class="form-title">Login</h2>
    <div class="container col-md-6 text-start bg-light p-4 rounded shadow-sm">
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
        <form method="POST" onsubmit="return validateLoginForm();">
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="footer text-center">
    <p>Developed By Prapti_222014082</p>
</footer>

<!-- JS Validation -->
<script>
function validateLoginForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!email || !password) {
        alert("Please fill in all fields.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
