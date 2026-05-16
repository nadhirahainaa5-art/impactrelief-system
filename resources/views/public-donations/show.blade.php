<!DOCTYPE html>
<html lang="en">
<script>
document.addEventListener('DOMContentLoaded', function () {
    const amountButtons = document.querySelectorAll('.amount-btn');
    const donateBtn = document.getElementById('donateNowBtn');

    let selectedAmount = 10;

    function updateDonateLink() {
        donateBtn.href = "{{ route('public-donations.create') }}" 
            + "?campaign_id={{ $campaign->id }}"
            + "&amount=" + selectedAmount;
    }

    updateDonateLink();

    amountButtons.forEach(button => {
        button.addEventListener('click', function () {
            amountButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            let amount = this.dataset.amount;

            if (amount === 'custom') {
                amount = prompt('Enter donation amount');

                if (!amount || isNaN(amount) || Number(amount) <= 0) {
                    return;
                }
            }

            selectedAmount = amount;
            updateDonateLink();
        });
    });
});
</script>
<head>
    <meta charset="UTF-8">
    <title>{{ $campaign->title }}</title>

    <style>
        .top-header {
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(18px);
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 999;
}

.top-header-inner {
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.brand-area {
    display: flex;
    align-items: center;
    gap: 16px;
}

.brand-logo {
    width: 50px;
    height: 50px;
    border-radius: 16px;
    background: linear-gradient(135deg, #08783f, #10b981);
    color: white;
    font-weight: 900;
    display: flex;
    align-items: center;
    justify-content: center;
}

.brand-area h3 {
    margin: 0;
    font-size: 24px;
}

.brand-area p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}

.header-contact {
    border-left: 2px solid #cbd5e1;
    padding-left: 18px;
    color: #64748b;
}
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(16,185,129,.16), transparent 30%),
                radial-gradient(circle at top right, rgba(59,130,246,.14), transparent 32%),
                radial-gradient(circle at bottom left, rgba(249,115,22,.12), transparent 30%),
                linear-gradient(180deg, #ffffff 0%, #f7fff9 100%);
            color: #0f172a;
        }
        .top-header {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 4px 16px rgba(15,23,42,.08);
    position: sticky;
    top: 0;
    z-index: 50;
}

.top-header-inner {
    max-width: 1500px;
    margin: 0 auto;
    padding: 22px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.brand-area {
    display: flex;
    align-items: center;
    gap: 16px;
}

.brand-logo {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: linear-gradient(135deg, #08783f, #10b981);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
}

.brand-area h3 {
    margin: 0;
    font-size: 24px;
    color: #0f172a;
}

.brand-area p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}

.header-contact {
    color: #64748b;
    font-size: 16px;
    border-left: 2px solid #94a3b8;
    padding-left: 16px;
}

        .page {
            max-width: 1500px;
            margin: 0 auto;
            padding: 26px 22px 70px;
        }

        .back {
            display: inline-flex;
            margin-bottom: 22px;
            color: #08783f;
            text-decoration: none;
            font-weight: 900;
            padding: 11px 18px;
            background: white;
            border: 1px solid #d6eadf;
            border-radius: 999px;
            box-shadow: 0 10px 22px rgba(15,23,42,.05);
        }

        .hero-card {
            border-radius: 34px;
            overflow: hidden;
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 28px 65px rgba(15,23,42,.09);
            margin-bottom: 34px;
        }

        .hero-top {
            padding: 48px;
            background:
                radial-gradient(circle at 15% 20%, rgba(250,204,21,.22), transparent 22%),
                radial-gradient(circle at 80% 25%, rgba(96,165,250,.18), transparent 24%),
                linear-gradient(135deg, #f0fff6, #ffffff);
        }

        .badge {
            display: inline-flex;
            padding: 9px 15px;
            border-radius: 999px;
            background: #dcfce7;
            color: #08783f;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        h1 {
            font-size: 56px;
            line-height: 1.05;
            margin: 0 0 16px;
            color: #07160f;
            letter-spacing: -1.5px;
            max-width: 900px;
        }

        .tagline {
            font-size: 21px;
            line-height: 1.7;
            color: #475569;
            margin: 0 0 26px;
            max-width: 900px;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .primary-btn,
        .secondary-btn {
            text-decoration: none;
            padding: 15px 22px;
            border-radius: 12px;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .primary-btn {
            background: linear-gradient(135deg, #08783f, #10b981);
            color: white;
            box-shadow: 0 16px 30px rgba(8,120,63,.22);
        }

        .secondary-btn {
            background: white;
            color: #0f172a;
            border: 1px solid #dbe8df;
        }

        .video-section {
            margin-bottom: 36px;
        }

        .video-header {
            margin-bottom: 18px;
        }

        .section-label {
            color: #08783f;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 34px;
            margin: 0 0 18px;
            color: #07160f;
            letter-spacing: -.6px;
        }

        .video-box {
            width: 100%;
            height: 720px;
            border-radius: 34px;
            overflow: hidden;
            background: #000;
            box-shadow: 0 25px 60px rgba(15,23,42,.18);
        }

        .video-box iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-placeholder {
            height: 100%;
            background: linear-gradient(135deg, #08783f, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 30px;
        }

        .play-icon {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: white;
            color: #08783f;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 16px;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 28px;
            align-items: start;
        }

        .story-card,
        .poster-card,
        .transparency-card,
        .donation-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 28px;
            box-shadow: 0 18px 42px rgba(15,23,42,.07);
        }

        .story-card,
        .poster-card,
        .transparency-card {
            padding: 34px;
            margin-bottom: 26px;
        }

        .story-card p {
            font-size: 18px;
            line-height: 1.9;
            color: #1f2937;
            margin: 0 0 20px;
        }

        .quote {
            margin: 28px 0 0;
            padding: 24px;
            border-left: 6px solid #10b981;
            background: #f0fdf4;
            border-radius: 18px;
            font-size: 20px;
            line-height: 1.7;
            color: #064e3b;
            font-style: italic;
        }

        .poster-wrap {
            background: #f8fafc;
            border-radius: 28px;
            padding: 18px;
            border: 1px solid #e2e8f0;
        }

        .poster {
            width: 100%;
            max-height: 720px;
            object-fit: contain;
            border-radius: 22px;
            display: block;
            background: #f8fafc;
        }

        .poster-placeholder {
            height: 430px;
            border-radius: 22px;
            background: linear-gradient(135deg, #10b981, #60a5fa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 84px;
            color: white;
        }

        .usage-box {
            margin-top: 20px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 22px;
            border-radius: 20px;
            line-height: 1.9;
            color: #14532d;
            font-size: 16px;
        }

        .donation-card {
            padding: 26px;
            position: sticky;
            top: 24px;
        }

        .progress-top {
            display: flex;
            justify-content: space-between;
            font-weight: 900;
            margin-bottom: 10px;
            color: #0b1f16;
        }

        .progress-bg {
            height: 12px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #2563eb);
            border-radius: 999px;
        }

        .amount-raised {
            font-size: 28px;
            font-weight: 900;
            color: #08783f;
            margin-bottom: 4px;
        }

        .amount-goal {
            color: #64748b;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 22px;
        }

        .info {
            background: #f8fcfa;
            border: 1px solid #dbeee3;
            border-radius: 18px;
            padding: 15px;
        }

        .info span {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .info strong {
            color: #0f172a;
            font-size: 18px;
            font-weight: 900;
        }

        .amount-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
            margin: 18px 0;
        }

        .amount-options button {
    background: #f0fdf4;
    color: #08783f;
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    padding: 12px 6px;
    text-align: center;
    font-weight: 900;
    font-size: 14px;
    cursor: pointer;
    transition: .2s ease;
}

.amount-options button:hover {
    background: #08783f;
    color: white;
    transform: translateY(-2px);
}

.amount-options button.active {
    background: linear-gradient(135deg,#08783f,#10b981);
    color: white;
    border-color: #08783f;
}

        .donate-btn {
            display: block;
            width: 100%;
            text-align: center;
            background: linear-gradient(135deg, #dc2626, #f97316);
            color: white;
            text-decoration: none;
            padding: 16px 20px;
            border-radius: 999px;
            font-weight: 900;
            box-shadow: 0 16px 30px rgba(220,38,38,.22);
        }

        .secure-note {
            margin-top: 14px;
            font-size: 13px;
            color: #64748b;
            text-align: center;
            line-height: 1.5;
        }

        .expense-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .expense-box {
            background: #f8fcfa;
            border: 1px solid #dbeee3;
            border-radius: 20px;
            padding: 18px;
        }

        .expense-box span {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .expense-box strong {
            color: #08783f;
            font-size: 22px;
            font-weight: 900;
        }

        .expense-table-wrapper {
            margin-top: 24px;
            max-height: 255px;
            overflow-y: auto;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
        }

        .expense-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .expense-table th {
            background: #eefbf3;
            color: #0b1f16;
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        .expense-table td {
            padding: 15px;
            border-bottom: 1px solid #eef2f7;
            color: #475569;
        }

        .empty-text {
            color: #64748b;
            line-height: 1.7;
        }

        @media(max-width: 1100px) {
            .video-box {
                height: 560px;
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            .donation-card {
                position: static;
            }
        }

        @media(max-width: 700px) {
            .page {
                padding: 20px 14px 50px;
            }

            .hero-top {
                padding: 28px;
            }

            h1 {
                font-size: 36px;
            }

            .tagline {
                font-size: 17px;
            }

            .video-box {
                height: 320px;
                border-radius: 22px;
            }

            .story-card,
            .poster-card,
            .transparency-card {
                padding: 24px;
            }

            .expense-grid,
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>


<body>
@include('components.public-header')
<header class="top-header">
    <div class="top-header-inner">
        <div class="brand-area">
            <div class="brand-logo">
                IR
            </div>

            <div>
                <h3>ImpactRelief</h3>
                <p>Humanitarian Donation & Relief Platform</p>
            </div>
        </div>

        <div class="header-contact">
            support@impactrelief.org.my
        </div>
    </div>
</header>

<div class="page">

    <a href="{{ route('public-donations.catalog') }}" class="back">
        ← Back to Campaign Catalog
    </a>

    @php
        $goal = $campaign->funding_goal ?? 0;
        $raised = $campaign->amount_raised ?? 0;
        $used = $totalExpensesUsed ?? 0;
        $remaining = $remainingBalance ?? 0;

        $percentage = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
        $donors = 120 + ($campaign->id * 17);

        $youtubeUrl = $campaign->youtube_url ?? null;
    @endphp

    <div class="hero-card">
        <div class="hero-top">

            <span class="badge">✓ {{ strtoupper($campaign->status) }} CAMPAIGN</span>

            <h1>{{ $campaign->title }}</h1>

            <p class="tagline">
                {{ $campaign->tagline ?? $campaign->description ?? 'Sumbangan anda mampu memberi harapan baharu kepada komuniti yang memerlukan.' }}
            </p>

            <div class="hero-actions">
                <a href="{{ route('public-donations.create', ['campaign_id' => $campaign->id]) }}" class="primary-btn">
                    ❤ Sumbang Sekarang
                </a>

                <a href="#story" class="secondary-btn">
                    Baca Kisah Kempen
                </a>
            </div>

        </div>
    </div>

    <section class="video-section">
        <div class="video-header">
            <div class="section-label">Campaign Video</div>
            <h2>Lihat Kisah Di Sebalik Kempen Ini</h2>
        </div>

        <div class="video-box">
            @if(!empty($youtubeUrl))
                <iframe src="{{ $youtubeUrl }}" allowfullscreen></iframe>
            @else
                <div class="video-placeholder">
                    <div>
                        <div class="play-icon">▶</div>
                        <h3>Campaign video will be displayed here</h3>
                        <p>Tambah YouTube embed link untuk paparkan video kempen.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <div class="main-grid">

        <main>

            <section class="story-card" id="story">
                <div class="section-label">Campaign Story</div>

                <h2>Mereka Perlukan Sokongan Kita</h2>

                <p>
                    {!! nl2br(e($campaign->campaign_story ?? $campaign->description ?? 'No campaign story has been provided yet.')) !!}
                </p>

                <div class="quote">
                    “Sebaik-baik manusia adalah yang paling bermanfaat kepada manusia lain.”
                </div>
            </section>

            <section class="poster-card">
                <div class="section-label">Campaign Poster</div>

                <h2>Poster Kempen</h2>

                <div class="poster-wrap">
                    @if(!empty($campaign->poster_path))
                        <img src="{{ asset('storage/' . $campaign->poster_path) }}"
                             alt="{{ $campaign->title }}"
                             class="poster">
                    @else
                        <div class="poster-placeholder">🤲</div>
                    @endif
                </div>
            </section>

            <section class="transparency-card">
                <div class="section-label">Transparency</div>

                <h2>Donation Usage Transparency</h2>

                @if($campaign->donation_usage)
                    <div class="usage-box">
                        {!! nl2br(e($campaign->donation_usage)) !!}
                    </div>
                @endif

                <p class="empty-text" style="margin-top:20px;">
                    We believe in transparency and accountability. Below is a summary of how
                    donated funds are being used to support this campaign.
                </p>

                <div class="expense-grid">
                    <div class="expense-box">
                        <span>Total Donations Raised</span>
                        <strong>RM {{ number_format($raised, 2) }}</strong>
                    </div>

                    <div class="expense-box">
                        <span>Total Expenses Used</span>
                        <strong>RM {{ number_format($used, 2) }}</strong>
                    </div>

                    <div class="expense-box">
                        <span>Remaining Balance</span>
                        <strong>RM {{ number_format($remaining, 2) }}</strong>
                    </div>
                </div>

                @if($approvedExpenses->count() > 0)
                    <div class="expense-table-wrapper">
                        <table class="expense-table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($approvedExpenses as $expense)
                                <tr>
                                    <td>{{ $expense->created_at->format('d M Y') }}</td>
                                    <td>{{ $expense->expense_type ?? 'Campaign Expense' }}</td>
                                    <td>RM {{ number_format($expense->amount, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="empty-text">
                        No approved expenses have been recorded yet.
                    </p>
                @endif
            </section>

        </main>

        <aside class="donation-card">

            <div class="progress-top">
                <span>Campaign Progress</span>
                <span>{{ $percentage }}%</span>
            </div>

            <div class="progress-bg">
                <div class="progress-fill" style="width: {{ $percentage }}%"></div>
            </div>

            <div class="amount-raised">
                RM {{ number_format($raised, 2) }}
            </div>

            <div class="amount-goal">
                raised of RM {{ number_format($goal, 2) }} goal
            </div>

            <div class="info-grid">
                <div class="info">
                    <span>Donors</span>
                    <strong>{{ $donors }}</strong>
                </div>

                <div class="info">
                    <span>Beneficiaries</span>
                    <strong>{{ $campaign->target_beneficiaries ?? '-' }}</strong>
                </div>

                <div class="info">
                    <span>Status</span>
                    <strong>{{ ucfirst($campaign->status) }}</strong>
                </div>

                <div class="info">
                    <span>Progress</span>
                    <strong>{{ $percentage }}%</strong>
                </div>
            </div>

            <h3>Pilih Jumlah Sumbangan</h3>

<div class="amount-options">

    <button type="button" class="amount-btn" data-amount="10">
        RM10
    </button>

    <button type="button" class="amount-btn" data-amount="30">
        RM30
    </button>

    <button type="button" class="amount-btn" data-amount="50">
        RM50
    </button>

    <button type="button" class="amount-btn" data-amount="100">
        RM100
    </button>

    <button type="button" class="amount-btn" data-amount="200">
        RM200
    </button>

    <button type="button" class="amount-btn" data-amount="custom">
        Custom
    </button>

</div>

<input type="hidden" id="selectedAmount" value="10">

<a id="donateNowBtn"
   href="{{ route('public-donations.create') }}?campaign_id={{ $campaign->id }}&amount=10"
   class="donate-btn">
    Proceed to Donation
</a>

            <div class="secure-note">
                🔒 Secure donation. Your contribution will support this campaign directly.
            </div>

        </aside>

    </div>

</div>

</body>
</html>