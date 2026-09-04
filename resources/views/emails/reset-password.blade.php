<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1a5276, #2c6b9e);
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }
        .header p {
            color: rgba(255,255,255,0.8);
            margin: 5px 0 0;
            font-size: 14px;
        }
        .body {
            padding: 40px;
        }
        .body h2 {
            color: #1a2a3a;
            font-size: 20px;
            margin-top: 0;
        }
        .body p {
            color: #4a5568;
            font-size: 15px;
            line-height: 1.7;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #1a5276, #2c6b9e);
            color: #ffffff !important;
            padding: 14px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            margin: 20px 0;
            box-shadow: 0 6px 20px rgba(26, 82, 118, 0.25);
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(26, 82, 118, 0.35);
        }
        .footer {
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #eef2f7;
            font-size: 13px;
            color: #6b7a8f;
        }
        .footer a {
            color: #1a5276;
            text-decoration: none;
        }
        .expiry-note {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            color: #6b7a8f;
            border-left: 4px solid #1a5276;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📚 University Repository</h1>
            <p>Reset Your Password</p>
        </div>

        <!-- Body -->
        <div class="body">
            <h2>Hello,</h2>
            <p>We received a request to reset your password for your University Repository account.</p>
            <p>Click the button below to set a new password:</p>

            <div style="text-align: center;">
                <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}" class="btn">
                    🔐 Reset Password
                </a>
            </div>

            <div class="expiry-note">
                ⏰ This password reset link will expire in <strong>60 minutes</strong>.
            </div>

            <p style="font-size: 14px; color: #6b7a8f;">
                If you did not request a password reset, please ignore this email.<br>
                Your password will not be changed unless you click the link above.
            </p>

            <hr style="border: none; border-top: 1px solid #eef2f7; margin: 25px 0;">

            <p style="font-size: 13px; color: #6b7a8f;">
                <strong>Need help?</strong> Contact our support team at 
                <a href="mailto:support@universityrepository.com">support@universityrepository.com</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} University Repository Management System. All rights reserved.</p>
            <p>
                <a href="#">Privacy Policy</a> &bull; 
                <a href="#">Terms of Service</a>
            </p>
        </div>
    </div>
</body>
</html>