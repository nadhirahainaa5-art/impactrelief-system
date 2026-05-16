<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Donation</title>

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
                radial-gradient(circle at top left, #e7fff1, transparent 35%),
                linear-gradient(180deg, #ffffff 0%, #f4fbf7 100%);
            color: #0f172a;
        }

        .page {
            max-width: 980px;
            margin: 0 auto;
            padding: 30px 18px 70px;
        }

        .back {
            display: inline-flex;
            margin-bottom: 22px;
            color: #08783f;
            text-decoration: none;
            font-weight: 900;
            padding: 10px 16px;
            background: white;
            border: 1px solid #d6eadf;
            border-radius: 999px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 88px;
            height: 88px;
            border-radius: 26px;
            background: linear-gradient(135deg, #08783f, #0f9f55);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 26px;
            box-shadow: 0 18px 35px rgba(8,120,63,.25);
        }

        h1 {
            font-size: 52px;
            line-height: 1.1;
            margin: 22px 0 12px;
            color: #0b1f16;
            letter-spacing: -1.5px;
        }

        .subtitle {
            font-size: 19px;
            color: #53665b;
            margin: 0;
        }

        .form-card {
            background: white;
            border: 1px solid #dbe8df;
            border-radius: 34px;
            padding: 34px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .08);
        }

        .section-title {
            font-size: 18px;
            font-weight: 900;
            color: #08783f;
            margin: 0 0 20px;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .field {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: 900;
            color: #0b1f16;
            margin-bottom: 9px;
            font-size: 15px;
        }

        input, select, textarea {
            width: 100%;
            padding: 16px 18px;
            border: 1px solid #cbd8d0;
            border-radius: 18px;
            font-size: 16px;
            background: #ffffff;
            outline: none;
            transition: .2s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #08783f;
            box-shadow: 0 0 0 4px rgba(8,120,63,.08);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .amount-box {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .amount-btn {
            border: 1px solid #dbe8df;
            background: #f4fbf7;
            color: #08783f;
            font-weight: 900;
            padding: 13px;
            border-radius: 16px;
            cursor: pointer;
        }

        .amount-btn:hover {
            background: #08783f;
            color: white;
        }

        .hint {
            font-size: 13px;
            color: #64748b;
            margin-top: 8px;
        }

        .payment-note {
            margin-top: 10px;
            padding: 14px 16px;
            border-radius: 18px;
            background: #fff7ed;
            color: #9a3412;
            font-size: 14px;
            border: 1px solid #fed7aa;
        }

        .divider {
            height: 1px;
            background: #e5eee8;
            margin: 30px 0;
        }

        .submit-area {
            margin-top: 28px;
            padding: 24px;
            border-radius: 26px;
            background: linear-gradient(135deg, #0b7a3b, #22c55e);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        .submit-area h2 {
            margin: 0 0 6px;
            font-size: 23px;
        }

        .submit-area p {
            margin: 0;
            opacity: .9;
        }

        .submit-btn {
            border: none;
            background: #d71920;
            color: white;
            font-weight: 900;
            font-size: 16px;
            padding: 16px 28px;
            border-radius: 999px;
            cursor: pointer;
            white-space: nowrap;
            box-shadow: 0 14px 25px rgba(215,25,32,.25);
        }

        .errors {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 18px;
            padding: 16px;
            margin-bottom: 24px;
        }

        @media(max-width: 760px) {
            .grid, .amount-box {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 38px;
            }

            .form-card {
                padding: 24px;
            }

            .submit-area {
                flex-direction: column;
                align-items: flex-start;
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('components.public-header')

<div class="page">

    <a href="{{ route('public-donations.catalog') }}" class="back">
        ← Back to Donation Catalog
    </a>

    <div class="header">
        <div class="logo">NGO</div>

        <h1>Complete Your Donation</h1>

        <p class="subtitle">
            Fill in your details and choose your preferred secure payment method.
        </p>
    </div>

    <form method="POST"
          action="{{ route('public-donations.store') }}"
          enctype="multipart/form-data"
          class="form-card">

        @csrf

        @if ($errors->any())
            <div class="errors">
                <strong>Please check the form:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="section-title">Donor Information</p>

        <div class="grid">
            <div class="field">
                <label>Full Name</label>
                <input type="text" name="donor_name" value="{{ old('donor_name') }}" required>
            </div>

            <div class="field">
                <label>Email Address</label>
                <input type="email" name="donor_email" value="{{ old('donor_email') }}" required>
            </div>
        </div>

        <div class="field">
            <label>Phone Number</label>
            <input type="text" name="donor_phone" value="{{ old('donor_phone') }}" placeholder="Example: 0123456789">
        </div>

        <div class="divider"></div>

        <p class="section-title">Campaign Details</p>

        <div class="field">
    <label>Selected Campaign</label>

    <select name="campaign_id" id="campaignSelect">
        <option value="">Select Campaign</option>

        @foreach($campaigns as $campaign)
            <option
                value="{{ $campaign->id }}"
                data-title="{{ $campaign->title }}"
                data-poster="{{ $campaign->poster_path ? asset('storage/' . $campaign->poster_path) : '' }}"
                data-goal="{{ number_format($campaign->funding_goal, 2) }}"
                {{ request('campaign_id') == $campaign->id || old('campaign_id') == $campaign->id ? 'selected' : '' }}
            >
                {{ $campaign->title }}
            </option>
        @endforeach
    </select>
</div>

<div id="campaign-preview"
     style="
        display:none;
        margin-top:22px;
        background:#f8fcfa;
        border:1px solid #dbeee3;
        border-radius:28px;
        overflow:hidden;
     ">

    <div id="campaign-preview-image"
         style="
            height:220px;
            background-size:cover;
            background-position:center;
         ">
    </div>

    <div style="padding:22px;">
        <h3 id="campaign-preview-title"
            style="margin:0 0 10px; color:#0b1f16;">
        </h3>

        <p style="margin:0; color:#64748b;">
            Funding Goal:
            <strong id="campaign-preview-goal"></strong>
        </p>
    </div>

</div>

        <div class="divider"></div>

        <p class="section-title">Donation Amount</p>

        <div class="amount-box">
            <button type="button" class="amount-btn" onclick="setAmount(10)">RM10</button>
            <button type="button" class="amount-btn" onclick="setAmount(30)">RM30</button>
            <button type="button" class="amount-btn" onclick="setAmount(50)">RM50</button>
            <button type="button" class="amount-btn" onclick="setAmount(100)">RM100</button>
        </div>

        <div class="grid">
            <div class="field">
                <label>Amount (RM)</label>
                <input id="amount" type="number" name="amount" min="1" step="0.01" value="{{ old('amount', request('amount')) }}" required>
            </div>

            <div class="field">
                <label>Donation Date</label>
                <input type="date" name="donation_date" value="{{ old('donation_date', date('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="divider"></div>

        <p class="section-title">Payment Information</p>

        <div class="grid">
            <div class="field">
                <label>Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="Online Banking">Online Banking</option>
                    <option value="FPX">FPX</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="E-Wallet">E-Wallet</option>
                    
                </select>
            </div>

            <div class="field" id="bank-section" style="display:none;">
                <label>Payment Gateway</label>

<select name="payment_gateway" id="payment_gateway">
    <option value="">Select Payment Gateway</option>
</select>

<div class="hint">
    Available gateways will change based on selected payment method.
</div>
            </div>
        </div>

        <div class="payment-note">
            This system uses simulated payment for academic/project purposes.
        </div>

        <div class="grid" style="margin-top:22px;">
            <div class="field">
                <label>Donation Type</label>
                <select name="type" required>
                    <option value="One-time">One-time</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>

            <div class="field">
                <label>Upload Payment Proof</label>
                <input type="file" name="proof_file">
                <div class="hint">Accepted file: JPG, PNG, PDF. Max 3MB.</div>
            </div>
        </div>

        <div class="field">
            <label>Note</label>
            <textarea name="note" placeholder="Optional note...">{{ old('note') }}</textarea>
        </div>

        <div class="submit-area">
            <div>
                <h2>Ready to submit?</h2>
                <p>Your donation will be recorded and reviewed for verification.</p>
            </div>

            <button type="submit" class="submit-btn">
                Submit Donation
            </button>
        </div>

    </form>

</div>

<script>
    function setAmount(value) {
        document.getElementById('amount').value = value;
    }

    const paymentMethod = document.getElementById('payment_method');
    const bankSection = document.getElementById('bank-section');

    function toggleBankSection() {
    if (
        paymentMethod.value === 'Online Banking' ||
        paymentMethod.value === 'FPX' ||
        paymentMethod.value === 'E-Wallet' ||
        paymentMethod.value === 'Credit Card' ||
        paymentMethod.value === 'Debit Card' ||
        paymentMethod.value === 'Bank Transfer'
    ) {
        bankSection.style.display = 'block';
    } else {
        bankSection.style.display = 'none';
    }
}

    paymentMethod.addEventListener('change', toggleBankSection);
    toggleBankSection();

    const gatewaySelect =
    document.getElementById('payment_gateway');

function updateGatewayOptions() {

    const method = paymentMethod.value;

    let options = [];

    if (method === 'Online Banking' || method === 'FPX') {

        options = [
            'Maybank',
            'CIMB Bank',
            'Public Bank',
            'RHB Bank',
            'Hong Leong Bank',
            'AmBank',
            'Bank Islam',
            'Bank Muamalat',
            'BSN',
            'Affin Bank',
            'UOB Malaysia',
            'OCBC Bank',
            'HSBC Malaysia',
            'Standard Chartered'
        ];

    } else if (method === 'E-Wallet') {

        options = [
            'Touch n Go eWallet',
            'GrabPay',
            'Boost',
            'ShopeePay'
        ];

    } else if (
        method === 'Credit Card' ||
        method === 'Debit Card'
    ) {

        options = [
            'Visa',
            'Mastercard'
        ];

    } else if (method === 'Bank Transfer') {

        options = [
            'Manual Bank Transfer'
        ];
    }

    gatewaySelect.innerHTML =
        '<option value="">Select Payment Gateway</option>';

    options.forEach(function(option) {

        gatewaySelect.innerHTML +=
            `<option value="${option}">${option}</option>`;

    });
}

paymentMethod.addEventListener('change', updateGatewayOptions);

updateGatewayOptions();

    const campaignSelect = document.getElementById('campaignSelect');

function updateCampaignPreview() {

    const selected =
        campaignSelect.options[campaignSelect.selectedIndex];

    const poster = selected.dataset.poster;
    const title = selected.dataset.title;
    const goal = selected.dataset.goal;

    const preview =
        document.getElementById('campaign-preview');

    if (!title) {
        preview.style.display = 'none';
        return;
    }

    preview.style.display = 'block';

    document.getElementById('campaign-preview-title')
        .innerText = title;

    document.getElementById('campaign-preview-goal')
        .innerText = 'RM' + goal;

    if (poster) {
        document.getElementById('campaign-preview-image')
            .style.backgroundImage = `url(${poster})`;
    } else {
        document.getElementById('campaign-preview-image')
            .style.background =
            'linear-gradient(135deg,#08783f,#34d399)';
    }
}

campaignSelect.addEventListener('change', updateCampaignPreview);

updateCampaignPreview();
</script>

</body>
</html>