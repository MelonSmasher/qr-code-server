<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting For Settings</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            margin: 0;
            line-height: 1.6;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .logo {
            max-width: 120px;
            margin: 0 auto 20px;
            display: block;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
        }

        p {
            color: #7f8c8d;
            font-size: 16px;
            margin: 0 0 10px;
        }

        .info {
            margin-top: 20px;
            text-align: left;
        }

        .info p {
            margin: 10px 0;
        }

        .info p span {
            display: block;
            background-color: #ecf0f1;
            border: 1px solid #bdc3c7;
            padding: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 16px;
            border-radius: 4px;
            color: #2c3e50;
            margin-top: 5px;
            word-wrap: break-word;
        }

        .extra-message {
            margin-top: 20px;
            font-style: italic;
            color: #95a5a6;
        }

        .help-message {
            margin-top: 20px;
            color: #2980b9;
        }

        .qr-code {
            margin-top: 20px;
            text-align: center;
        }

        .qr-code img {
            max-width: 200px;
            margin-top: 10px;
        }

        .qr-code p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .help-message a {
            color: #fff;
            background-color: #2980b9;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }

        .help-message a:hover {
            background-color: #3498db;
        }

        .footer, .secondary-footer {
            margin-top: 30px;
            font-size: 12px;
            color: #bdc3c7;
        }

        .footer a, .secondary-footer a {
            color: #2980b9;
            text-decoration: none;
        }

        .footer a:hover, .secondary-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    {{--    <img src="cid:{{ logo_url }}" alt="{{ company_name }} Logo" class="logo">--}}
    <div class="info">
        <p>Send wireless information to the webhook and this page will populate...</p>
    </div>
</div>
</body>
</html>
