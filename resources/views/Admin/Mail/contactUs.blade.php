<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            color: #333;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #0d6efd;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .body {
            padding: 30px;
        }
        .footer {
            background-color: #f4f4f4;
            color: #777;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Hello, {{ $name }}!</h1>
        </div>
        <div class="body">
           <p> The answer of your query-{{ $reply }}</p>

            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
