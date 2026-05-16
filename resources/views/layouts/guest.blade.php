<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NGOFund') }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg-start: #edfdf4;
            --bg-mid: #f8fafc;
            --bg-end: #dff7ea;
            --card-bg: rgba(255, 255, 255, 0.96);
            --card-border: #d1fae5;
            --brand-dark: #15803d;
            --brand-light: #10b981;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --white-soft: #ecfdf5;
            --shadow: 0 25px 60px rgba(15, 23, 42, 0.14);
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-mid) 45%, var(--bg-end) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: var(--text-main);
        }

        .guest-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .guest-card {
            width: 100%;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
        }

        .guest-header {
            padding: 30px 28px 24px;
            background: linear-gradient(135deg, var(--brand-dark), var(--brand-light));
            text-align: center;
            color: white;
        }

        .badge {
            width: 68px;
            height: 68px;
            margin: 0 auto;
            border-radius: 20px;
            background: #ffffff;
            color: var(--brand-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 0.02em;
            box-shadow: 0 10px 24px rgba(255, 255, 255, 0.18);
        }

        .guest-header h1 {
            margin: 16px 0 6px;
            font-size: 30px;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .guest-header p {
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
            color: var(--white-soft);
        }

        .guest-body {
            padding: 28px;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .guest-wrapper {
                max-width: 100%;
            }

            .guest-header {
                padding: 24px 20px 22px;
            }

            .guest-header h1 {
                font-size: 26px;
            }

            .guest-body {
                padding: 22px 20px;
            }

            .badge {
                width: 60px;
                height: 60px;
                font-size: 18px;
                border-radius: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="guest-wrapper">
        <div class="guest-card">
            <div class="guest-header">
                <div class="badge">IR</div>
<h1>ImpactRelief</h1>
<p>Humanitarian Donation & Relief Platform</p>
            </div>

            <div class="guest-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>