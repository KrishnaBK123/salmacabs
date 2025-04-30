<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'connect_db.php';

    $name = trim($_POST["name"]);
    $mobile = trim($_POST["mobile"]);
    $success = false;
    $message = "";

    if (empty($name) || empty($mobile)) {
        $message = "Name and mobile number are required.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE name = ? AND mobile = ?");
        $stmt->bind_param("ss", $name, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $success = true;
        } else {
            $message = "Invalid credentials. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
    header("Content-Type: application/json");
    echo json_encode(["success" => $success, "message" => $message]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Salma Cabs</title>
  <meta name="description" content="Best Airport Taxi services in Bangalore.">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/mybooking.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .input-field { margin-bottom: 20px; padding: 10px; width: 100%; }
    .login-button { width: 100%; padding: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <div class="logo-container">
        <div class="logo">
          <img src="images/logo 1.png" alt="Ridek Logo">
        </div>
        <div class="logo-tagline">24/7 available</div>
      </div>
    </div>

    <div class="right-panel">
      <div class="login-container">
        <h1 class="login-title">Customer Login</h1>
        <form id="login-form">
          <input type="text" id="name" name="name" class="input-field" placeholder="Enter your name" required>
          <input type="text" id="mobile" name="mobile" class="input-field" placeholder="Enter mobile number" required>
          <button type="button" id="send-otp-btn" class="login-button">Submit</button>
        </form>
      </div>

      <div class="footer1">
        <div class="contact-info">
          <div class="website"><i class="fas fa-globe"></i><span>www.salmacabs@gmail.com</span></div>
          <div class="phone"><i class="fas fa-phone"></i><span>+91 8919699221</span></div>
        </div>
        <div class="social-icons">
          <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i></a>
          <a href="mailto:salmacabs@gmail.com" class="social-icon email"><i class="fas fa-envelope"></i></a>
        </div>
        <div class="copyright">
          © Copyright 2025 Salma Cabs - All Rights Reserved
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("send-otp-btn").addEventListener("click", async function () {
      const name = document.getElementById("name").value.trim();
      const mobile = document.getElementById("mobile").value.trim();

      if (name === "" || mobile === "") {
        alert("Please enter your name and mobile number.");
        return;
      }

      const formData = new FormData();
      formData.append("name", name);
      formData.append("mobile", mobile);

      try {
        const response = await fetch("mybooking.php", {
          method: "POST",
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          alert("Login successful!");
          window.location.href = "userhome.html";
        } else {
          alert(result.message);
        }
      } catch (err) {
        console.error("Login error:", err);
        alert("Something went wrong.");
      }
    });
  </script>
</body>
</html>
