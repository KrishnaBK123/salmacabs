<?php
$status = $_GET['status'] ?? 'error';
$message = $_GET['message'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status | Salma Cabs</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .modal {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            animation: pop 0.5s ease-out;
        }
        .modal h2 {
            margin-bottom: 10px;
        }
        .checkmark {
            font-size: 50px;
            margin-bottom: 20px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        @keyframes pop {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

</head>
<body>

<div class="modal">
    <?php if ($status === 'success'): ?>
        <div class="checkmark success">✅</div>
        <h2 class="success">Booking Successful</h2>
        <p>Your cab has been booked successfully!</p>
    <?php else: ?>
        <div class="checkmark error">❌</div>
        <h2 class="error">Booking Failed</h2>
        <p><?php echo htmlspecialchars(urldecode($message)); ?></p>
    <?php endif; ?>
</div>

<script>
    setTimeout(function() {
        window.location.href = 'index.html'; // Redirect to home page after 3 seconds
    }, 3000);
</script>

</body>
</html>
