<?php
// Hostinger Server Settings
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Data Collect Karein (HTML 'name' attributes se)
    $name = strip_tags(trim($_POST["fullName"]));
    $email = filter_var(trim($_POST["workEmail"]), FILTER_SANITIZE_EMAIL);
    $company = strip_tags(trim($_POST["companyName"]));
    $url = strip_tags(trim($_POST["projectUrl"]));
    $tech = strip_tags(trim($_POST["techStack"]));
    $message = strip_tags(trim($_POST["description"]));

    // 2. Email Configuration
    $recipient = "waqasahmmedsqa@gmail.com"; // Jahan aapko report chahiye
    $subject = "New Project Submission from $name";
    
    // Email Content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Company: $company\n";
    $email_content .= "Project URL: $url\n";
    $email_content .= "Tech Stack: $tech\n\n";
    $email_content .= "Message:\n$message\n";

    // Hostinger required header (Apne domain ka email use karein)
    $headers = "From: contact@yourdomain.com"; 

    // 3. Send Email
    if (mail($recipient, $subject, $email_content, $headers)) {
        echo json_encode(["status" => "success", "message" => "Thank you! Your application has been submitted."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Opps! Something went wrong."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
}
?>