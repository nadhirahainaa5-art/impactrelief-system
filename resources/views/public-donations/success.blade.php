<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Donation Submitted</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4fbf7;
            color: #052e16;
        }

        .public-header {
            background: white;
            padding: 26px 48px;
            border-bottom: 1px solid #d8eadc;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-mark {
    width: 58px;
    height: 58px;
    border-radius: 18px;
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 22px;
    box-shadow: 0 10px 25px rgba(21, 128, 61, 0.25);
}

        .brand-title {
            font-size: 26px;
            font-weight: 900;
            color: #052e16;
        }

        .brand-subtitle {
            color: #617767;
            margin-top: 4px;
            font-size: 15px;
        }

        .page-wrap {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 24px;
        }

        .content-card,
        .metric-card,
        .detail-box {
            background: white;
            border: 1px solid #d8eadc;
            box-shadow: 0 14px 35px rgba(21, 128, 61, 0.10);
        }

        .content-card {
            border-radius: 34px;
            padding: 42px;
        }

        .eyebrow {
            color: #15803d;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .muted {
            color: #617767;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-top: 28px;
        }

        .metric-card {
            border-radius: 24px;
            padding: 24px;
        }

        .metric-label {
            font-size: 14px;
            color: #617767;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .metric-value {
            margin: 0;
            color: #066033;
            font-size: 30px;
            font-weight: 900;
        }

        .section-gap {
            margin-top: 30px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .detail-box {
            border-radius: 22px;
            padding: 22px;
        }

        .detail-box span {
            display: block;
            color: #617767;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .detail-box strong {
            color: #066033;
            font-size: 18px;
        }

        .toolbar {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 22px;
            border-radius: 14px;
            font-weight: 900;
            text-decoration: none;
        }

        .btn {
            background: #15803d;
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #166534;
            border: 1px solid #b7d9bf;
        }

        @media (max-width: 900px) {
            .cards,
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .public-header {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<header class="public-header">
    <div class="logo-mark">IR</div>

    <div>
        <div class="brand-title">ImpactRelief</div>
        <div class="brand-subtitle">Humanitarian Operations Platform</div>
    </div>
</header>

<div class="page-wrap">

    <div class="content-card" style="text-align:center;">
        <div style="font-size:60px; margin-bottom:16px;">✅</div>

        <p class="eyebrow">DONATION SUBMITTED</p>

        <h1 style="margin:0 0 12px;">
            Thank You for Your Contribution
        </h1>

        <p class="muted" style="max-width:620px; margin:0 auto; line-height:1.8;">
            Your donation has been recorded successfully and is currently waiting for verification.
            Once verified, it will be reflected in the campaign donation progress.
        </p>
    </div>

    <div class="cards">
        <div class="metric-card">
            <div class="metric-label">Transaction Reference</div>
            <h3 class="metric-value" style="font-size:20px;">
                {{ $donation->transaction_reference ?? '-' }}
            </h3>
        </div>

        <div class="metric-card">
            <div class="metric-label">Donation Amount</div>
            <h3 class="metric-value">
                RM{{ number_format($donation->amount, 2) }}
            </h3>
        </div>

        <div class="metric-card">
            <div class="metric-label">Verification Status</div>
            <h3 class="metric-value" style="font-size:22px;">
                {{ ucfirst($donation->status) }}
            </h3>
        </div>

        <div class="metric-card">
            <div class="metric-label">Donation Date</div>
            <h3 class="metric-value" style="font-size:22px;">
                {{ $donation->donation_date ? $donation->donation_date->format('d M Y') : '-' }}
            </h3>
        </div>
    </div>

    <div class="content-card section-gap">
        <h3 style="margin-top:0;">Donation Summary</h3>

        <div class="detail-grid">
            <div class="detail-box">
                <span>Campaign</span>
                <strong>{{ $donation->campaign->title ?? 'General Donation' }}</strong>
            </div>

            <div class="detail-box">
                <span>Payment Method</span>
                <strong>{{ $donation->payment_method ?? '-' }}</strong>
            </div>

            <div class="detail-box">
                <span>Bank / Gateway</span>
                <strong>{{ $donation->payment_gateway ?? '-' }}</strong>
            </div>

            <div class="detail-box">
                <span>Receipt Number</span>
                <strong>{{ $donation->receipt_number ?? 'Pending Verification' }}</strong>
            </div>
        </div>
    </div>

    <div class="toolbar">
        <a href="{{ route('donations.certificate', $donation->id) }}" class="btn">
            View Certificate
        </a>

        <a href="{{ route('public-donations.catalog') }}" class="btn">
            Browse More Campaigns
        </a>

        <a href="{{ route('public-donations.create') }}" class="btn-secondary">
            Submit Another Donation
        </a>
    </div>

</div>

</body>
</html>