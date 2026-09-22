<?php
session_start();

// If no session data exists, redirect user back to the form
if (!isset($_SESSION['booking_data'])) {
    header("Location: index.html");
    exit();
}

$data = $_SESSION['booking_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation Summary</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
            padding: 30px 0;
        }

        .summary-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 550px;
        }

        h2 {
            color: #2d6a4f;
            margin-bottom: 8px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .detail-group {
            margin-bottom: 15px;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .detail-label {
            font-weight: 600;
            color: #4a5568;
        }

        .detail-value {
            color: #2d3748;
            text-align: right;
        }

        .btn-home {
            display: block;
            text-align: center;
            background: #2d6a4f;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 25px;
            transition: background 0.2s;
        }

        .btn-home:hover {
            background: #1b4332;
        }
    </style>
</head>
<body>

    <div class="summary-card">
        <h2>Booking Confirmed! 🎉</h2>
        <p class="subtitle">Here are the registration details submitted for your hike:</p>

        <div class="detail-group">
            <span class="detail-label">Full Name:</span>
            <span class="detail-value"><?php echo htmlspecialchars($data['fullname']); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Email Address:</span>
            <span class="detail-value"><?php echo htmlspecialchars($data['email']); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Phone Number:</span>
            <span class="detail-value"><?php echo htmlspecialchars($data['phone']); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Date of Birth:</span>
            <span class="detail-value"><?php echo htmlspecialchars($data['dob']); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Experience Level:</span>
            <span class="detail-value"><?php echo ucfirst(htmlspecialchars($data['experience'])); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Emergency Contact:</span>
            <span class="detail-value"><?php echo htmlspecialchars($data['emergency_contact']); ?></span>
        </div>

        <div class="detail-group">
            <span class="detail-label">Dietary / Notes:</span>
            <span class="detail-value"><?php echo !empty($data['dietary']) ? htmlspecialchars($data['dietary']) : 'None provided'; ?></span>
        </div>

        <div class="detail-group" style="border-bottom: none;">
            <span class="detail-label">Ticket Tier:</span>
            <span class="detail-value"><?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($data['ticket_tier']))); ?></span>
        </div>

        <a href="index.html" class="btn-home">Register Another Hiker</a>
    </div>

</body>
</html>