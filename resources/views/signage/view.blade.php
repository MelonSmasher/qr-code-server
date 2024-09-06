<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$ppsk->name}} Wi-Fi Access Information</title>
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
            max-width: 1024px;
            margin: 0 auto;
            text-align: center;
        }

        .logo {
            max-width: 250px;
            margin: 0 auto 20px;
            display: block;
        }

        h1 {
            color: #2c3e50;
            font-size: 42px;
        }

        p {
            color: #7f8c8d;
            font-size: 16px;
            margin: 0 0 10px;
        }

        .info {
            text-align: left;
            flex: 1;
            margin-top: 20px;
            background-color: #ffffff;
            padding: 20px;
            margin-left: 10px;
            min-height: 345px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .info p {
            margin: 10px 0;
            margin-top: 30px;
        }

        .info p span {
            display: block;
            background-color: #ecf0f1;
            border: 1px solid #bdc3c7;
            padding: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 18px;
            border-radius: 4px;
            color: #2c3e50;
            margin-top: 5px;
            word-wrap: break-word;
        }

        .qr-code {
            margin-top: 20px;
            margin-right: 10px;
            text-align: center;
            flex: 1;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

        }

        .qr-code img {
            max-width: 375px;
            margin-top: 5px;
        }

        .qr-code p {
            color: #7f8c8d;
            font-size: 20px;
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

        .info-qr-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .vertical-divider {
            width: 1px;
            background-color: #bdc3c7;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="container">
    @if (!empty(config('app.logo_base64', null)))
        <img src="{{ config('app.logo_base64') }}" alt="{{ config('app.company_name') }} Logo" class="logo">
    @endif
    <h1>{{$ppsk->name}} Wi-Fi</h1>
    @if(!empty($ppsk->settings->qr_code_path) )
        <p>Scan the QR code below to connect to the network</p>
    @else
        <p>Connect to the network using the following information</p>
    @endif
    <div class="info-qr-wrapper">
        <div class="info">
            <p><strong>Wi-Fi Network:</strong><span>{{ $ppsk->settings->ssid }}</span></p>
            @if(!empty($ppsk->settings->identity) )
                <p><strong>Username:</strong><span>{{ $ppsk->settings->identity }}</span></p>
            @endif
            @if(!empty($ppsk->settings->passphrase) )
                <p><strong>Wi-Fi Passphrase:</strong><span>{{ $ppsk->settings->passphrase }}</span></p>
            @endif
        </div>
        <div class="vertical-divider"></div>
        @if(!empty($ppsk->settings->qr_code_path) )

            <div class="qr-code">
                <img src="{{ URL::to('/storage/'.$ppsk->settings->qr_code_path) }}" alt="QR Code">
            </div>
        @endif
    </div>
    @if (!empty(config('app.company_name', null)))
        <div class="footer">
            <p>&copy; {{ \Carbon\Carbon::now()->year }} {{ config('app.company_name') }}</p>
        </div>
    @endif
</div>
</body>
</html>
