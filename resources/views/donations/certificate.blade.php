<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Donation Certificate</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: #f0fdf4;
            padding: 10px;
            color: #052e16;
        }

        .certificate {
            max-width: 1000px;
            min-height: auto;
            margin: auto;
            background: white;
            border: 14px solid #15803d;
            padding: 25px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(21, 128, 61, 0.25);
        }

        .inner-border {
            border: 4px solid #86efac;
            min-height: auto;
            padding: 30px 40px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #15803d, #22c55e);
            color: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: bold;
        }

        h1 {
            margin: 0;
            font-size: 46px;
            color: #166534;
        }

        h2 {
            margin: 10px 0 30px;
            font-size: 24px;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .text {
            font-size: 19px;
            margin: 12px 0;
            color: #374151;
        }

        .donor-name {
            font-size: 42px;
            font-weight: bold;
            color: #052e16;
            margin: 25px auto;
            border-bottom: 2px solid #15803d;
            display: inline-block;
            padding: 0 40px 8px;
            min-width: 250px;
        }

        .amount {
            font-size: 34px;
            font-weight: bold;
            color: #15803d;
            margin: 18px 0;
        }

        .campaign {
            font-size: 21px;
            margin-top: 15px;
            color: #052e16;
        }

        .date {
            font-size: 17px;
            color: #4b5563;
            margin-top: 18px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
            padding: 0 80px;
        }

        .signature {
            text-align: center;
            width: 260px;
            color: #052e16;
        }

        .signature-space {
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .signature-line {
            border-top: 2px solid #052e16;
            margin: 8px auto 8px;
            width: 230px;
        }

        /* PROFESSIONAL STAMP */

        .stamp {
            width: 120px;
            height: 120px;
            border: 4px solid #15803d;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: rgba(21, 128, 61, 0.03);
        }

        .stamp::before {
            content: "";
            position: absolute;
            inset: 6px;
            border: 2px solid #15803d;
            border-radius: 50%;
        }

        .stamp-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #15803d;
            font-family: Georgia, serif;
        }

        .stamp-main {
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2;
            letter-spacing: 1px;
        }

        /* BUTTON SECTION */

        .certificate-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        .certificate-buttons .print-btn,
        .certificate-buttons .back-btn {
            width: 240px;
            height: 52px;
            margin: 0;
        }

        .print-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #15803d;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #166534;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #14532d;
        }

        @media print {

            @page {
                size: A4 landscape;
                margin: 0;
            }

            html,
            body {
                width: 297mm;
                height: 210mm;
                margin: 0;
                padding: 0;
                background: white;
                overflow: hidden;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .certificate {
                width: 297mm;
                height: 210mm;
                max-width: none;
                min-height: auto;
                margin: 0;
                padding: 10mm;
                border: 8mm solid #15803d;
                box-shadow: none;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            .inner-border {
                height: 100%;
                min-height: auto;
                padding: 10mm 18mm;
                border: 2mm solid #86efac;
                page-break-inside: avoid;
            }

            .logo-circle {
                width: 16mm;
                height: 16mm;
                font-size: 16px;
                margin-bottom: 8px;
            }

            h1 {
                font-size: 34px;
            }

            h2 {
                font-size: 16px;
                margin: 6px 0 16px;
            }

            .text {
                font-size: 14px;
                margin: 8px 0;
            }

            .donor-name {
                font-size: 30px;
                margin: 14px auto;
                padding-bottom: 5px;
            }

            .amount {
                font-size: 26px;
                margin: 10px 0;
            }

            .campaign {
                font-size: 16px;
                margin-top: 8px;
            }

            .date {
                font-size: 13px;
                margin-top: 8px;
            }

            .footer {
                margin-top: 28px;
                padding: 0 45mm;
            }

            .signature-space {
                height: 30mm;
            }

            .signature-line {
                width: 55mm;
            }

            .stamp {
                width: 28mm;
                height: 28mm;
            }

            .stamp-main {
                font-size: 11px;
            }

            .print-btn,
            .back-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="certificate">
    <div class="inner-border">

        <div class="logo-circle">IR</div>

        <h1>Certificate of Appreciation</h1>
        <h2>NGO Donation Recognition</h2>

        <p class="text">This certificate is proudly presented to</p>

<div class="donor-name">
    {{ $donation->donor_name ?? $donation->donor->full_name ?? 'Esteemed Supporter' }}
</div>

        <p class="text">in appreciation of the generous contribution of</p>

        <div class="amount">
            RM {{ number_format($donation->amount ?? 0, 2) }}
        </div>

        <div class="campaign">
            For Campaign:
            <strong>{{ $donation->campaign->title ?? 'NGO Campaign' }}</strong>
        </div>

        <div class="date">
            Donation Date:
            {{ $donation->created_at->format('d M Y') }}
        </div>

        <div class="footer">

            <div class="signature">
                <div class="signature-space">
                    <div style="
                        font-family: 'Brush Script MT', cursive;
                        font-size: 28px;
                        color: #111;
                        margin-bottom: 8px;
                    ">
                        Aiman Zaki
                    </div>
                </div>

                <div class="signature-line"></div>
                <strong>NGO Administrator</strong>
            </div>

            <div class="signature">

                <div class="stamp">

                    <div class="stamp-content">

                        <div class="stamp-main">
                            IMPACT
                        </div>

                        <div class="stamp-main">
                            RELIEF
                        </div>

                    </div>

                </div>

                <div class="signature-line"></div>
                <strong>Official Stamp</strong>

            </div>

        </div>

    </div>
</div>

<div class="certificate-buttons">

    <button onclick="window.print()" class="print-btn">
        Print Certificate
    </button>

    <a href="{{ route('public-donations.success', $donation->id) }}"
       class="back-btn">
        Back to Donation Page
    </a>

</div>

</body>
</html>