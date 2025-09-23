<?php
function generateVerificationEmail($code, $title = "Email Verification", $intro = "Thank you for registering with Prefix") {
    // HTML body
    $html = "
    <div style='
        font-family: Arial, sans-serif; 
        background: #f9f9f9; 
        padding: 20px; 
        border-radius: 10px; 
        border: 1px solid #e0e0e0; 
        max-width: 500px; 
        margin: auto;
    '>
        <h2 style='color: #3498db; text-align: center; margin-bottom: 20px;'>
            $title
        </h2>

        <p style='font-size: 16px; color: #333; text-align: center;'>
            $intro
        </p>

        <div style='
            font-size: 26px; 
            font-weight: bold; 
            color: #2c3e50; 
            background: #ecf6fd;
            border: 2px dashed #3498db; 
            padding: 12px 20px; 
            text-align: center; 
            border-radius: 8px; 
            margin: 20px auto;
            display: inline-block;
            width: 80%;
        '>
            $code
        </div>

        <p style='font-size: 14px; color: #e74c3c; text-align: center;'>
            ⚠️ This code will expire in <strong>15 minutes</strong>.
        </p>

        <p style='font-size: 13px; color: #7f8c8d; text-align: center; margin-top: 20px;'>
            If you did not request this code, please ignore this email.
        </p>
    </div>
    ";

    // Plain-text body (fallback for clients that block HTML)
    $plain = "$title\n\n"
        . "$intro\n\n"
        . "Your verification code is: $code\n\n"
        . "This code will expire in 15 minutes.\n\n"
        . "If you did not request this code, please ignore this email.";

    return [
        "html" => $html,
        "plain" => $plain
    ];
}
?>