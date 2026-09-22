<?php
session_start();
$errors = array();

// Retrieve and safely check all POST data using ternary operators
$fullname          = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$email             = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone             = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$dob               = isset($_POST['dob']) ? trim($_POST['dob']) : '';
$experience        = isset($_POST['experience']) ? trim($_POST['experience']) : '';
$emergency_contact = isset($_POST['emergency_contact']) ? trim($_POST['emergency_contact']) : '';
$ticket_tier       = isset($_POST['ticket_tier']) ? trim($_POST['ticket_tier']) : '';
$ccnumber          = isset($_POST['ccnumber']) ? trim($_POST['ccnumber']) : '';
$ccexpiry          = isset($_POST['ccexpiry']) ? trim($_POST['ccexpiry']) : '';
$cccvv             = isset($_POST['cccvv']) ? trim($_POST['cccvv']) : '';

// 1. Full Name Validation
if (empty($fullname) || !preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
    $errors[] = "Invalid Full Name. Only alphabetical characters and spaces are allowed.";
}

// 2. Email Format Validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// 3. Phone Number Validation (10 digits)
if (!preg_match("/^\d{10}$/", $phone)) {
    $errors[] = "Invalid Phone Number. It must consist of exactly 10 digits.";
}

// 4. Date of Birth Validation & Age Check (Must be at least 12 years old)
if (!empty($dob)) {
    $date_parts = explode('-', $dob);
    if (count($date_parts) == 3 && checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
        $birth_timestamp = strtotime($dob);
        $min_age_timestamp = strtotime('-12 years');
        if ($birth_timestamp > time()) {
            $errors[] = "Date of Birth cannot be in the future.";
        } elseif ($birth_timestamp > $min_age_timestamp) {
            $errors[] = "Hikers must be at least 12 years of age to register.";
        }
    } else {
        $errors[] = "Invalid Date of Birth format.";
    }
} else {
    $errors[] = "Date of Birth is required.";
}

// 5. Experience Level Validation
$valid_experiences = ['beginner', 'intermediate', 'advanced'];
if (!in_array($experience, $valid_experiences)) {
    $errors[] = "Please select a valid hiking experience level.";
}

// 6. Emergency Contact Validation
if (empty($emergency_contact) || strlen($emergency_contact) < 5) {
    $errors[] = "Emergency Contact details are required.";
}

// 7. Ticket Tier Validation
$valid_tiers = ['standard', 'gear_rental', 'vip'];
if (!in_array($ticket_tier, $valid_tiers)) {
    $errors[] = "Please select a valid ticket tier.";
}

// 8. Credit Card Number Validation (Must be exactly 16 digits)
if (!preg_match("/^\d{16}$/", $ccnumber)) {
    $errors[] = "Invalid Credit Card Number. It must consist of exactly 16 digits.";
}

// 9. Expiry Date Validation (Format MM/YY)
if (!preg_match("/^(0[1-9]|1[0-2])\/([0-9]{2})$/", $ccexpiry, $matches)) {
    $errors[] = "Invalid Expiry Date format. Please use MM/YY.";
} else {
    $exp_month = (int)$matches[1];
    $exp_year = (int)("20" . $matches[2]);
    $current_year = (int)date('Y');
    $current_month = (int)date('m');

    if ($exp_year < $current_year || ($exp_year == $current_year && $exp_month < $current_month)) {
        $errors[] = "Credit Card has expired.";
    }
}

// 10. CVV Validation (Must be exactly 3 digits)
if (!preg_match("/^\d{3}$/", $cccvv)) {
    $errors[] = "Invalid CVV. It must consist of 3 digits.";
}

// Check validation results
if (empty($errors)) {
    $_SESSION['booking_data'] = [
        'fullname'          => $fullname,
        'email'             => $email,
        'phone'             => $phone,
        'dob'               => $dob,
        'experience'        => $experience,
        'emergency_contact' => $emergency_contact,
        'ticket_tier'       => $ticket_tier,
        'ccnumber'          => $ccnumber
    ];
    
    header("Location: success.php");
    exit();
} else {
    echo "<div style='max-width: 500px; margin: 50px auto; padding: 25px; border-radius: 8px; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.15); font-family: sans-serif;'>";
    echo "<h3 style='color: #c53030; margin-bottom: 12px;'>Please fix the following validation errors:</h3>";
    foreach ($errors as $e) {
        echo "<p style='color: #c53030; margin: 6px 0;'>- " . htmlspecialchars($e) . "</p>";
    }
    echo "<br><a href='index.html' style='display:inline-block; margin-top:10px; color:#2d6a4f; text-decoration:none; font-weight:bold;'>&larr; Go Back to Booking Form</a>";
    echo "</div>";
}
?>