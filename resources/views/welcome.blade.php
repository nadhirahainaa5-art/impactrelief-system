<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ImpactRelief</title>

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
            background: #f7fbf8;
            color: #10231a;
        }

        .container {
            width: min(1180px, 92%);
            margin: auto;
        }

        header {
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e1eee6;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .nav-wrap {
            height: 86px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            gap: 14px;
            align-items: center;
            text-decoration: none;
            color: #10231a;
        }

        .logo {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, #08783f, #16a34a);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 20px;
            box-shadow: 0 14px 30px rgba(8,120,63,.22);
        }

        .brand h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
        }

        .brand p {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .nav {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav a {
            text-decoration: none;
            color: #10231a;
            font-weight: 800;
        }

        .login-btn {
            padding: 12px 20px;
            border-radius: 999px;
            border: 1px solid #cfe7d8;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
        }

        .hero {
            padding: 76px 0 50px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 56px;
            align-items: center;
        }

        .badge {
            display: inline-flex;
            padding: 10px 18px;
            border-radius: 999px;
            background: #e8fbef;
            color: #08783f;
            font-weight: 900;
            border: 1px solid #bdeccb;
            margin-bottom: 22px;
        }

        h1 {
            font-size: 62px;
            line-height: 1.05;
            letter-spacing: -2px;
            margin: 0;
            color: #092017;
        }

        h1 span {
            color: #08783f;
        }

        .hero-text {
            margin-top: 22px;
            font-size: 19px;
            line-height: 1.75;
            color: #53665b;
            max-width: 650px;
        }

        .actions {
            margin-top: 34px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            padding: 16px 28px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 900;
            align-items: center;
            justify-content: center;
        }

        .btn-red {
            background: #d71920;
            color: white;
            box-shadow: 0 16px 30px rgba(215,25,32,.22);
        }

        .btn-green {
            background: white;
            color: #08783f;
            border: 1px solid #cfe7d8;
        }

        .hero-panel {
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 34px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(15,23,42,.09);
        }

        .panel-image {
            height: 260px;
            background:
                linear-gradient(rgba(8,120,63,.65), rgba(8,120,63,.65)),
                url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1200&q=80");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 26px;
            color: white;
        }

        .panel-image h2 {
            margin: 0;
            font-size: 30px;
            max-width: 420px;
        }

        .panel-body {
            padding: 26px;
        }

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 14px;
        }

        .mini-card {
            padding: 20px;
            border-radius: 22px;
            background: #f2fbf6;
            border: 1px solid #dcefe4;
        }

        .mini-card span {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .mini-card strong {
            color: #08783f;
            font-size: 28px;
            font-weight: 900;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 18px;
            margin: 28px 0 70px;
        }

        .stat {
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 28px;
            padding: 26px;
            box-shadow: 0 14px 35px rgba(15,23,42,.05);
        }

        .stat strong {
            display: block;
            font-size: 34px;
            color: #08783f;
            margin-bottom: 8px;
        }

        .stat span {
            color: #64748b;
            line-height: 1.5;
        }

        .section {
            padding: 70px 0;
        }

        .section-head {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 38px;
        }

        .section-head h2 {
            font-size: 42px;
            margin: 0 0 12px;
            letter-spacing: -1px;
            color: #092017;
        }

        .section-head p {
            color: #64748b;
            font-size: 18px;
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 22px;
        }

        .feature {
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 14px 35px rgba(15,23,42,.05);
        }

        .feature-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: #e8fbef;
            color: #08783f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 18px;
        }

        .feature h3 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .feature p {
            margin: 0;
            color: #64748b;
            line-height: 1.7;
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 22px;
        }

        .campaign-card {
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 14px 35px rgba(15,23,42,.05);
        }
.campaign-cover {
    width: 100%;
    height: 230px;
    border-radius: 24px 24px 0 0;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    overflow: hidden;
    display: block;
}

        .campaign-body {
            padding: 22px;
        }


        .campaign-body h3 {
            margin: 0 0 10px;
            font-size: 21px;
        }

        .campaign-body p {
            color: #64748b;
            line-height: 1.6;
            min-height: 54px;
        }

        .campaign-body a {
            color: #08783f;
            font-weight: 900;
            text-decoration: none;
        }
        .share-row {
    margin-top: 16px;
    display: flex;
    gap: 10px;
    align-items: center;
}

.share-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border: 1px solid #dbe8df;
    background: #f8fcfa;
    transition: all 0.2s ease;
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 80, 40, 0.12);
}

.share-icon {
    width: 18px;
    height: 18px;
}

        .cta {
            margin: 60px 0;
            padding: 46px;
            border-radius: 36px;
            background:
                linear-gradient(rgba(8,120,63,.88), rgba(8,120,63,.88)),
                url("https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=1200&q=80");
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .cta h2 {
            margin: 0 0 10px;
            font-size: 36px;
        }

        .cta p {
            margin: 0;
            opacity: .92;
        }

        footer {
            padding: 26px 0;
            text-align: center;
            color: #64748b;
            border-top: 1px solid #dbe8df;
        }

        @media(max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 46px;
            }

            .stats,
            .feature-grid,
            .campaign-grid {
                grid-template-columns: 1fr 1fr;
            }

            .cta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media(max-width: 620px) {
            .nav-wrap {
                height: auto;
                padding: 18px 0;
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .nav {
                width: 100%;
                justify-content: space-between;
            }

            h1 {
                font-size: 38px;
            }

            .stats,
            .feature-grid,
            .campaign-grid,
            .mini-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding-top: 46px;
            }

            .cta {
                padding: 30px;
            }
        }
.impact-section {
    position: relative;
    overflow: hidden;
    margin: 40px auto;
    width: 88%;
    min-height: 540px;
    border-radius: 30px;
    padding: 38px 46px;

    display: grid;
    grid-template-columns: 1.05fr 0.95fr;
    gap: 34px;
    align-items: center;

    background:
        linear-gradient(
            90deg,
            rgba(0, 31, 18, 0.94) 0%,
            rgba(0, 55, 33, 0.84) 45%,
            rgba(0, 55, 33, 0.55) 100%
        ),
        url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop');

    background-size: cover;
    background-position: center 38%;
    box-shadow: 0 24px 60px rgba(0,0,0,0.16);
}

.impact-left {
    position: relative;
    z-index: 2;
}

.impact-badge {
    display: inline-block;
    background: rgba(255,255,255,0.16);
    color: white;
    padding: 8px 15px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;
    margin-bottom: 14px;
}

.impact-left h2 {
    font-size: 36px;
    line-height: 1.08;
    font-weight: 900;
    color: white;
    margin-bottom: 14px;
    max-width: 430px;
}

.impact-left h2 span {
    color: #67f7b2;
}

.impact-left p {
    color: rgba(255,255,255,0.88);
    font-size: 14px;
    line-height: 1.6;
    max-width: 420px;
}

.impact-btn {
    margin-top: 22px;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: linear-gradient(135deg,#28c76f,#0e9f57);
    color: white;
    text-decoration: none;
    padding: 12px 21px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 800;
    box-shadow: 0 14px 28px rgba(0,0,0,0.2);
    transition: 0.25s ease;
}

.impact-btn:hover {
    transform: translateY(-3px);
}

.impact-right {
    position: relative;
    z-index: 2;

    display: flex;
    flex-direction: column;
    gap: 12px;

    margin-top: 20px;
}

.feature-box {
    background: rgba(255,255,255,0.96);
    border-radius: 20px;
    padding: 16px 18px;
    min-height: 92px;

    display: flex;
    align-items: center;
    gap: 14px;

    position: relative;

    box-shadow: 0 14px 30px rgba(0,0,0,0.13);
}

.feature-icon {
    min-width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #f4f8f6;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #006b3f;
}

.feature-icon svg {
    width: 22px;
    height: 22px;
}

.feature-text h3 {
    font-size: 17px;
    margin-bottom: 4px;
    color: #032314;
}

.feature-text p {
    font-size: 12.5px;
    color: #4d5d54;
    line-height: 1.4;
    max-width: 300px;
}

.feature-number {
    position: absolute;
    top: 12px;
    right: 18px;
    font-size: 26px;
    font-weight: 900;
    color: #e6ece8;
}

@media(max-width: 1100px) {
    .impact-section {
        grid-template-columns: 1fr;
        width: 92%;
        min-height: auto;
        padding: 30px;
        background-position: center;
    }

    .impact-left h2 {
        font-size: 32px;
    }

    .impact-left p {
        font-size: 13.5px;
    }

    .impact-right {
        margin-top: 8px;
    }

    .feature-box {
        min-height: auto;
        padding: 16px;
    }

    .feature-text h3 {
        font-size: 16px;
    }

    .feature-text p {
        font-size: 12px;
    }
}
    </style>
</head>

<body>
    @include('components.public-header')

<header>
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="brand">
            <div class="logo">IR</div>
            <div>
                <h3>ImpactRelief</h3>
                <p>Humanitarian Donation & Relief Platform</p>
            </div>
        </a>

        <nav class="nav">
            <a href="#features">Features</a>
            <a href="{{ route('login') }}" class="login-btn">Staff / Admin Login</a>
        </nav>
    </div>
</header>

<main class="container">

    <section class="hero">
        <div>
            <div class="badge">Trusted Humanitarian Relief & Donation Platform</div>

            <h1>
                Delivering Relief with
                <span>Transparency and Trust</span>
            </h1>

            <p class="hero-text">
                ImpactRelief helps communities receive support through verified campaigns,
                transparent donation tracking, staff-managed fund allocations, and
                administrator-approved reporting.
            </p>

            <div class="actions">
                <a href="{{ route('public-donations.catalog') }}" class="btn btn-red">
                    Donate Now →
                </a>

                <a href="#features" class="btn btn-green">
                    Learn More
                </a>
            </div>
        </div>

        <div class="hero-panel">
            <div class="panel-image">
                <h2>Every contribution helps create real impact.</h2>
            </div>

            <div class="panel-body">
                <div class="mini-grid">
                    <div class="mini-card">
                        <span>Active Campaigns</span>
                        <strong>{{ $campaigns->count() ?? 0 }}</strong>
                    </div>

                    <div class="mini-card">
                        <span>Donation Access</span>
                        <strong>Public</strong>
                    </div>

                    <div class="mini-card">
                        <span>Admin Review</span>
                        <strong>Yes</strong>
                    </div>

                    <div class="mini-card">
                        <span>Tracking</span>
                        <strong>100%</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stat">
            <strong>120+</strong>
            <span>Campaigns can be managed with structured approval flow.</span>
        </div>

        <div class="stat">
            <strong>RM500K+</strong>
            <span>Relief funds can be tracked from donation to spending.</span>
        </div>

        <div class="stat">
            <strong>3,000+</strong>
            <span>Donors can support campaigns without account registration.</span>
        </div>

        <div class="stat">
            <strong>100%</strong>
            <span>Transparent records for donations, allocations and expenses.</span>
        </div>
    </section>

    <section class="section" id="features">
        <div class="section-head">
            <h2>A Complete Relief Fund Management System</h2>
            <p>
                Built for NGOs that need organized donation records, approval workflows,
                public campaigns, and clear accountability.
            </p>
        </div>

        <section class="impact-section">

    <div class="impact-overlay"></div>

    <div class="impact-left">

        <span class="impact-badge">
            VERIFIED DONATION PLATFORM
        </span>

        <h2>
            Donate with <br>
            Confidence. <br>
            Track Every <br>
            <span>Impact Clearly.</span>
        </h2>

        <p>
            Support verified relief campaigns, contribute securely,
            and help NGOs deliver aid with better transparency
            and accountability.
        </p>

        <a href="{{ route('public-donations.create') }}" class="impact-btn">

            <svg width="24" height="24" fill="none" stroke="currentColor"
                 stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 21s-6-4.35-9-8.5C-1 6 3 1 8 4c1.5 1 2.5 2 4 4
                1.5-2 2.5-3 4-4 5-3 9 2 5 8.5C18 16.65 12 21 12 21z"/>
            </svg>

            Donate Now →
        </a>

    </div>

    <div class="impact-right">

        <div class="feature-box">

            <div class="feature-icon">

                <svg width="34" height="34" fill="none"
                     stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M12 21s-6-4.35-9-8.5C-1 6 3 1 8 4c1.5 1 2.5 2 4 4
                    1.5-2 2.5-3 4-4 5-3 9 2 5 8.5C18 16.65 12 21 12 21z"/>

                </svg>

            </div>

            <div class="feature-text">
                <h3>Public Donation</h3>
                <p>
                    Anyone can donate easily without creating an account.
                </p>
            </div>

            <span class="feature-number">01</span>

        </div>

        <div class="feature-box">

            <div class="feature-icon">

                <svg width="34" height="34" fill="none"
                     stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"/>
                    <path d="M9 12l2 2 4-4"/>

                </svg>

            </div>

            <div class="feature-text">
                <h3>Transparent Tracking</h3>
                <p>
                    Track donation progress and fund utilization clearly.
                </p>
            </div>

            <span class="feature-number">02</span>

        </div>

        <div class="feature-box">

            <div class="feature-icon">

                <svg width="34" height="34" fill="none"
                     stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M12 2l3 6 6 .9-4.5 4.4 1 6.2L12 17l-5.5 2.5
                    1-6.2L3 8.9 9 8z"/>

                </svg>

            </div>

            <div class="feature-text">
                <h3>Verified Campaigns</h3>
                <p>
                    All campaigns are reviewed and approved by admin.
                </p>
            </div>

            <span class="feature-number">03</span>

        </div>

    </div>

</section>
    </section>

    <section class="section">
        <div class="section-head">
            <h2>Featured Campaigns</h2>
            <p>Support verified relief campaigns and help communities in need.</p>
        </div>

        @if($campaigns->count() > 0)
            <div class="campaign-grid">
                @foreach($campaigns->take(3) as $campaign)
                    <div class="campaign-card">
                        @if($campaign->poster_path)
    <div class="campaign-cover"
         style="
            background:
            linear-gradient(rgba(5,46,27,.35), rgba(5,46,27,.35)),
            url('{{ asset('storage/' . $campaign->poster_path) }}');
            background-size: cover;
            background-position: center;
         ">
    </div>
@else
    <div class="campaign-cover">🤲</div>
@endif

<div class="campaign-body">
    <h3>{{ $campaign->title }}</h3>

    <p>{{ \Illuminate\Support\Str::limit($campaign->description, 90) }}</p>

    @php
        $campaignUrl = route('public-donations.show', $campaign->id);
        $shareText = 'Support this campaign: ' . $campaign->title;
    @endphp

    <a href="{{ $campaignUrl }}">
        View Campaign →
    </a>

    <div class="share-row">
    <a class="share-btn"
       target="_blank"
       title="Share to WhatsApp"
       href="https://wa.me/?text={{ urlencode($shareText . ' ' . $campaignUrl) }}">
        <img class="share-icon" src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/whatsapp.svg" alt="WhatsApp">
    </a>

    <a class="share-btn"
       target="_blank"
       title="Share to Facebook"
       href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($campaignUrl) }}">
        <img class="share-icon" src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/facebook.svg" alt="Facebook">
    </a>

    <a class="share-btn"
       target="_blank"
       title="Instagram"
       href="https://www.instagram.com/">
        <img class="share-icon" src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/instagram.svg" alt="Instagram">
    </a>

    <a class="share-btn"
       href="javascript:void(0)"
       title="Copy campaign link"
       onclick="navigator.clipboard.writeText('{{ $campaignUrl }}'); alert('Campaign link copied!')">
        <svg class="share-icon" fill="none" stroke="#08783f" stroke-width="2" viewBox="0 0 24 24">
            <path d="M10 13a5 5 0 0 1 0-7l1-1a5 5 0 0 1 7 7l-1 1"></path>
            <path d="M14 11a5 5 0 0 1 0 7l-1 1a5 5 0 0 1-7-7l1-1"></path>
        </svg>
    </a>
</div>
</div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align:center; color:#64748b;">No active campaigns available yet.</p>
        @endif
    </section>

    <section class="cta">
        <div>
            <h2>Ready to support a campaign?</h2>
            <p>Your donation helps deliver relief, care and hope to communities that need it most.</p>
        </div>

        <a href="{{ route('public-donations.catalog') }}" class="btn btn-red">
            Donate Now →
        </a>
    </section>

</main>

<footer>
    ImpactRelief © {{ date('Y') }}. Humanitarian Donation & Relief Management Platform.
</footer>

</body>
</html>