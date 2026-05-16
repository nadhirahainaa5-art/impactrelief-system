<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Catalog</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(16,185,129,.14), transparent 30%),
                linear-gradient(180deg, #ffffff 0%, #f6fbf8 100%);
            color: #0f172a;
        }

        .page {
            max-width: 1120px;
            margin: 0 auto;
            padding: 28px 20px 70px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 34px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
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

        .brand span {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-top: 3px;
        }

        .back {
            color: #08783f;
            text-decoration: none;
            font-weight: 900;
            padding: 10px 16px;
            border-radius: 999px;
            background: white;
            border: 1px solid #d6eadf;
        }

        .catalog-header {
            background:
                linear-gradient(135deg, rgba(8,120,63,.94), rgba(16,185,129,.82)),
                radial-gradient(circle at top right, rgba(255,255,255,.25), transparent 30%);
            border-radius: 30px;
            padding: 34px;
            color: white;
            margin-bottom: 28px;
            box-shadow: 0 24px 55px rgba(8,120,63,.18);
        }

        .catalog-header .badge {
            display: inline-block;
            background: rgba(255,255,255,.18);
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .catalog-header h1 {
            margin: 0 0 10px;
            font-size: 38px;
            letter-spacing: -1px;
        }

        .catalog-header p {
            margin: 0;
            max-width: 760px;
            font-size: 17px;
            line-height: 1.7;
            opacity: .95;
        }

        .filter-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .filter-pill {
            padding: 10px 15px;
            border-radius: 999px;
            background: white;
            border: 1px solid #dbe8df;
            color: #08783f;
            font-weight: 900;
            font-size: 13px;
            box-shadow: 0 8px 18px rgba(15,23,42,.04);
            cursor: pointer;
        }

        .filter-pill.active {
            background: #08783f;
            color: white;
            border-color: #08783f;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .campaign-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 26px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 18px 38px rgba(15,23,42,.07);
            transition: .22s ease;
        }

        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 26px 55px rgba(15,23,42,.11);
        }

        .campaign-card.hide {
            display: none;
        }

        .card-image {
            height: 190px;
            background: var(--soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 58px;
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status {
            position: absolute;
            left: 16px;
            top: 16px;
            background: white;
            color: #08783f;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
        }

        .category {
            position: absolute;
            right: 16px;
            top: 16px;
            background: var(--accent);
            color: white;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
        }

        .card-body {
            padding: 22px;
        }

        .title {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #07160f;
        }

        .desc {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            height: 45px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .progress-top {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #334155;
        }

        .progress-track {
            width: 100%;
            height: 9px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
            border-radius: 999px;
        }

        .amount {
            font-size: 18px;
            font-weight: 900;
            color: var(--accent);
            margin-bottom: 18px;
        }

        .amount span {
            color: #64748b;
            font-weight: 800;
            font-size: 14px;
        }

        .donate-btn {
            display: block;
            text-align: center;
            background: var(--accent);
            color: white;
            padding: 13px;
            border-radius: 13px;
            font-weight: 900;
        }

        .empty {
            text-align: center;
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 24px;
            padding: 38px;
            color: #64748b;
            box-shadow: 0 14px 35px rgba(15, 23, 42, .06);
        }

        @media(max-width: 950px) {
            .catalog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 640px) {
            .topbar {
                align-items: flex-start;
                gap: 14px;
                flex-direction: column;
            }

            .catalog-header {
                padding: 26px;
            }

            .catalog-header h1 {
                font-size: 30px;
            }

            .catalog-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
@include('components.public-header')

<div class="page">

    <div class="topbar">
        <div class="brand">
            <div class="logo-mark">IR</div>
            <div>
                Donation Catalog
                <span>Verified Campaigns</span>
            </div>
        </div>

        <a href="{{ route('home') }}" class="back">← Back to Home</a>
    </div>

    <section class="catalog-header">
        <span class="badge">Verified Donation Campaigns</span>
        <h1>Choose a Campaign to Support</h1>
        <p>
            Explore verified donation campaigns and contribute with confidence.
            Each campaign provides clear information so donors can understand where their support goes.
        </p>
    </section>

    <div class="filter-row">
        <button type="button" class="filter-pill active" data-filter="all">All Campaigns</button>
        <button type="button" class="filter-pill" data-filter="education">Education</button>
        <button type="button" class="filter-pill" data-filter="food">Food Aid</button>
        <button type="button" class="filter-pill" data-filter="community">Community</button>
        <button type="button" class="filter-pill" data-filter="emergency">Emergency</button>
    </div>

    @if($campaigns->count() > 0)

        <div class="catalog-grid">

            @foreach($campaigns as $campaign)

                @php
                    $text = strtolower(
                        ($campaign->category ?? '') . ' ' .
                        ($campaign->title ?? '') . ' ' .
                        ($campaign->description ?? '') . ' ' .
                        ($campaign->campaign_story ?? '') . ' ' .
                        ($campaign->donation_usage ?? '')
                    );
if (
    str_contains($text, 'school') ||
    str_contains($text, 'student') ||
    str_contains($text, 'education') ||
    str_contains($text, 'pelajar') ||
    str_contains($text, 'pendidikan') ||
    str_contains($text, 'anak yatim')
) {

    $categoryKey = 'education';
    $categoryLabel = 'Education';
    $accent = '#2563eb';
    $soft = '#dbeafe';
    $icon = '🎒';

} elseif (
    str_contains($text, 'emergency') ||
    str_contains($text, 'kecemasan') ||
    str_contains($text, 'disaster') ||
    str_contains($text, 'banjir') ||
    str_contains($text, 'flood')
) {

    $categoryKey = 'emergency';
    $categoryLabel = 'Emergency';
    $accent = '#dc2626';
    $soft = '#fee2e2';
    $icon = '🚨';

} elseif (
    str_contains($text, 'warga emas') ||
    str_contains($text, 'elderly') ||
    str_contains($text, 'community') ||
    str_contains($text, 'komuniti') ||
    str_contains($text, 'society')
) {

    $categoryKey = 'community';
    $categoryLabel = 'Community';
    $accent = '#10b981';
    $soft = '#dcfce7';
    $icon = '🤲';

} elseif (
    str_contains($text, 'food') ||
    str_contains($text, 'meal') ||
    str_contains($text, 'makanan') ||
    str_contains($text, 'nutrition')
) {

    $categoryKey = 'food';
    $categoryLabel = 'Food Aid';
    $accent = '#f97316';
    $soft = '#ffedd5';
    $icon = '🥗';

} else {

    $categoryKey = 'community';
    $categoryLabel = 'Community';
    $accent = '#10b981';
    $soft = '#dcfce7';
    $icon = '🤲';
}

                    $goal = $campaign->funding_goal ?? 0;
                    $raised = $campaign->amount_raised ?? 0;
                    $percentage = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
                @endphp

                <a href="{{ route('public-donations.show', $campaign->id) }}"
                   class="campaign-card"
                   data-category="{{ $categoryKey }}"
                   style="--accent: {{ $accent }}; --soft: {{ $soft }};">

                    <div class="card-image">
                        @if(!empty($campaign->poster_path))
                            <img src="{{ asset('storage/' . $campaign->poster_path) }}" alt="{{ $campaign->title }}">
                        @else
                            {{ $icon }}
                        @endif

                        <div class="status">{{ strtoupper($campaign->status) }}</div>
                        <div class="category">{{ $categoryLabel }}</div>
                    </div>

                    <div class="card-body">
                        <div class="title">{{ $campaign->title }}</div>

                        <div class="desc">
                            {{ $campaign->description ?? 'Your contribution can make a meaningful difference through this campaign.' }}
                        </div>

                        <div class="progress-top">
                            <span>Progress</span>
                            <span>{{ $percentage }}%</span>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                        </div>

                        <div class="amount">
                            RM {{ number_format($raised, 0) }}
                            <span>/ RM {{ number_format($goal, 0) }}</span>
                        </div>

                        <div class="donate-btn">
                            View Campaign →
                        </div>
                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="empty">
            No active campaigns are available at the moment.
        </div>

    @endif

</div>

<script>
    const filterButtons = document.querySelectorAll('.filter-pill');
    const campaignCards = document.querySelectorAll('.campaign-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const selectedFilter = this.dataset.filter;

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            campaignCards.forEach(card => {
                const campaignCategory = card.dataset.category;

                if (selectedFilter === 'all' || campaignCategory === selectedFilter) {
                    card.classList.remove('hide');
                } else {
                    card.classList.add('hide');
                }
            });
        });
    });
</script>

</body>
</html>