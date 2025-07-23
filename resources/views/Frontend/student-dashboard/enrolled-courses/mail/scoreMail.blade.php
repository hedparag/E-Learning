<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Score Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #89f7fe, #66a6ff);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 25px;
            text-align: center;
            font-size: 20px;
        }

        .content {
            padding: 30px;
            text-align: center;
        }

        .subject-name {
            font-size: 22px;
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .marks {
            background-color: #e3f2fd;
            display: inline-block;
            padding: 20px 30px;
            border-radius: 12px;
            font-size: 18px;
            color: #1976D2;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        🎓 Subject Score Report
    </div>

    <div class="content">
        <div class="subject-name">{{ $course_name }}</div>

        <div class="marks">
           {{ $name }} ,you scored {{ $marks }} out of {{ $total }}
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} EDUBIN. All rights reserved.
    </div>
</div>

</body>
</html>
