@extends('layouts.app')

@section('title', 'Create Campaign')
@section('page_title', 'Create Campaign')

@section('content')

<style>

    .campaign-create-hero{
        background:
            radial-gradient(circle at top right, rgba(255,255,255,.18), transparent 28%),
            linear-gradient(135deg,#052e1b,#0f9f55);
        color:white;
        border-radius:34px;
        padding:38px;
        margin-bottom:28px;
        display:flex;
        justify-content:space-between;
        gap:24px;
        align-items:center;
        box-shadow:0 24px 55px rgba(6,59,35,.20);
    }

    .campaign-create-hero h1{
        margin:0 0 10px;
        color:white;
        font-size:44px;
        letter-spacing:-1px;
    }

    .campaign-create-hero p{
        margin:0;
        color:#dcfce7;
        line-height:1.8;
        max-width:760px;
    }

    .campaign-create-hero .eyebrow{
        color:#bbf7d0;
        letter-spacing:.14em;
        font-weight:900;
        margin-bottom:12px;
        text-transform:uppercase;
        font-size:13px;
    }

    .hero-btn{
        background:white;
        color:#08783f;
        padding:14px 22px;
        border-radius:999px;
        font-weight:900;
        text-decoration:none;
        white-space:nowrap;
        box-shadow:0 14px 30px rgba(255,255,255,.14);
    }

    .campaign-create-layout{
        display:grid;
        grid-template-columns:1.2fr .8fr;
        gap:24px;
    }

    .premium-card{
        background:white;
        border:1px solid #dbeee3;
        border-radius:30px;
        padding:28px;
        box-shadow:0 18px 45px rgba(15,23,42,.06);
    }

    .premium-card h3{
        margin:0 0 22px;
        color:#0b1f16;
        font-size:26px;
    }

    .premium-field{
        margin-bottom:22px;
    }

    .premium-field label{
        display:block;
        margin-bottom:9px;
        font-weight:900;
        color:#0b1f16;
    }

    .premium-field input,
    .premium-field textarea{
        width:100%;
        border:1px solid #cbd8d0;
        border-radius:18px;
        padding:16px 18px;
        font-size:15px;
        outline:none;
        transition:.2s ease;
        background:white;
    }

    .premium-field textarea{
        resize:vertical;
    }

    .premium-field input:focus,
    .premium-field textarea:focus{
        border-color:#08783f;
        box-shadow:0 0 0 4px rgba(8,120,63,.08);
    }

    .premium-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:18px;
    }

    .poster-upload{
        border:1.5px dashed #b7d8c4;
        background:#f8fcfa;
        border-radius:24px;
        padding:22px;
        display:grid;
        grid-template-columns:110px 1fr;
        gap:18px;
        align-items:center;
    }

    .poster-icon{
        width:110px;
        height:110px;
        border-radius:22px;
        background:linear-gradient(135deg,#dcfce7,#86efac);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:42px;
    }

    .poster-upload strong{
        display:block;
        color:#0b1f16;
        font-size:18px;
        margin-bottom:6px;
    }

    .poster-upload span{
        display:block;
        color:#64748b;
        line-height:1.7;
        margin-bottom:12px;
    }

    .poster-upload input{
        border:none;
        padding:0;
        border-radius:0;
    }

    .guide-card{
        display:grid;
        gap:16px;
    }

    .guide-item{
        background:#f8fcfa;
        border:1px solid #e3f1e8;
        border-radius:22px;
        padding:18px;
        display:flex;
        gap:14px;
        align-items:flex-start;
    }

    .guide-icon{
        width:46px;
        height:46px;
        border-radius:16px;
        background:#dcfce7;
        color:#08783f;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:900;
        flex-shrink:0;
    }

    .guide-item strong{
        display:block;
        color:#0b1f16;
        margin-bottom:5px;
    }

    .guide-item span{
        color:#64748b;
        line-height:1.6;
        font-size:14px;
    }

    .submit-panel{
        margin-top:24px;
        background:linear-gradient(135deg,#0b7a3b,#22c55e);
        border-radius:28px;
        padding:26px;
        color:white;
        display:flex;
        justify-content:space-between;
        gap:18px;
        align-items:center;
    }

    .submit-panel h3{
        margin:0 0 6px;
        color:white;
    }

    .submit-panel p{
        margin:0;
        color:#dcfce7;
    }

    .submit-actions{
        display:flex;
        gap:12px;
        align-items:center;
    }

    .submit-btn{
        border:none;
        background:white;
        color:#08783f;
        padding:15px 24px;
        border-radius:999px;
        font-weight:900;
        cursor:pointer;
        white-space:nowrap;
    }

    .cancel-btn{
        border:1px solid rgba(255,255,255,.45);
        color:white;
        padding:14px 20px;
        border-radius:999px;
        text-decoration:none;
        font-weight:900;
        white-space:nowrap;
    }

    .hint{
        margin-top:8px;
        color:#64748b;
        font-size:13px;
        line-height:1.6;
    }

    .required{
        color:#dc2626;
    }

    @media(max-width:950px){

        .campaign-create-layout{
            grid-template-columns:1fr;
        }

        .campaign-create-hero{
            flex-direction:column;
            align-items:flex-start;
        }
    }

    @media(max-width:650px){

        .premium-grid,
        .poster-upload{
            grid-template-columns:1fr;
        }

        .campaign-create-hero h1{
            font-size:34px;
        }

        .submit-panel,
        .submit-actions{
            flex-direction:column;
            align-items:stretch;
        }

        .submit-btn,
        .cancel-btn{
            width:100%;
            text-align:center;
        }
    }

</style>

<div class="campaign-create-hero">

    <div>

        <p class="eyebrow">
            IMPACTRELIEF CAMPAIGN SUBMISSION
        </p>

        <h1>
            Create New Campaign
        </h1>

        <p>
            Create a humanitarian campaign with a clear objective,
            emotional storytelling, beneficiary impact and transparent
            donation usage plan. Admin will review the campaign
            before public donation is enabled.
        </p>

    </div>

    <a href="{{ route('campaigns.index') }}" class="hero-btn">
        Back to Campaigns
    </a>

</div>

<form method="POST"
      action="{{ route('campaigns.store') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="campaign-create-layout">

        <div class="premium-card">

            <h3>Campaign Information</h3>

            <div class="premium-field">

                <label>
                    Campaign Title
                    <span class="required">*</span>
                </label>

                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="Example: Back to School 2026"
                       required>

            </div>

            <div class="premium-field">

                <label>
                    Short Tagline
                    <span class="required">*</span>
                </label>

                <input type="text"
                       name="tagline"
                       value="{{ old('tagline') }}"
                       placeholder="Example: Help students continue their education journey."
                       required>

                <div class="hint">
                    Short emotional sentence that will appear on the public campaign page.
                </div>

            </div>

            <div class="premium-field">

                <label>
                    Campaign Story
                    <span class="required">*</span>
                </label>

                <textarea name="campaign_story"
                          rows="10"
                          placeholder="Explain the full campaign story, beneficiary struggles, why support is needed and how donations will create impact..."
                          required>{{ old('campaign_story') }}</textarea>

                <div class="hint">
                    Write a meaningful storytelling explanation to build donor trust and emotional connection.
                </div>

            </div>

            <div class="premium-field">

                <label>
                    Donation Usage Plan
                </label>

                <textarea name="donation_usage"
                          rows="4"
                          placeholder="Example: School supplies, food assistance, transportation support...">{{ old('donation_usage') }}</textarea>

                <div class="hint">
                    Explain clearly how the collected donations will be used.
                </div>

            </div>

            <div class="premium-field">

                <label>
                    YouTube Campaign Video
                </label>

                <input type="text"
                       name="youtube_url"
                       value="{{ old('youtube_url') }}"
                       placeholder="https://www.youtube.com/embed/VIDEO_ID">

                <div class="hint">
                    Optional. Add a YouTube embed link for the campaign video.
                </div>

            </div>

            <div class="premium-field">

                <label>
                    Campaign Poster
                </label>

                <div class="poster-upload">

                    <div class="poster-icon">
                        🖼️
                    </div>

                    <div>

                        <strong>
                            Upload Campaign Poster
                        </strong>

                        <span>
                            Upload a campaign image to make the campaign look professional
                            on the public donation page.
                            Recommended: JPG/PNG, square or 1080 × 1350px poster.
                        </span>

                        <input type="file"
                               name="poster"
                               accept="image/*">

                    </div>

                </div>

            </div>

            <div class="premium-grid">

                <div class="premium-field">

                    <label>
                        Funding Goal (RM)
                        <span class="required">*</span>
                    </label>

                    <input type="number"
                           name="funding_goal"
                           value="{{ old('funding_goal') }}"
                           min="1"
                           step="0.01"
                           placeholder="Example: 5000.00"
                           required>

                    <div class="hint">
                        Set the total amount needed for this campaign.
                    </div>

                </div>

                <div class="premium-field">

                    <label>
                        Target Beneficiaries
                    </label>

                    <input type="number"
                           name="target_beneficiaries"
                           value="{{ old('target_beneficiaries') }}"
                           min="0"
                           placeholder="Example: 200">

                    <div class="hint">
                        Estimated number of people who will benefit from this campaign.
                    </div>

                </div>

            </div>

            <div class="premium-grid">

                <div class="premium-field">

                    <label>
                        Campaign Start Date
                    </label>

                    <input type="date"
                           name="start_date"
                           value="{{ old('start_date') }}">

                </div>

                <div class="premium-field">

                    <label>
                        Campaign End Date
                    </label>

                    <input type="date"
                           name="end_date"
                           value="{{ old('end_date') }}">

                </div>

            </div>

            <div class="submit-panel">

                <div>

                    <h3>
                        Submit campaign for review?
                    </h3>

                    <p>
                        Admin will verify the campaign before it appears to public donors.
                    </p>

                </div>

                <div class="submit-actions">

                    <a href="{{ route('campaigns.index') }}"
                       class="cancel-btn">

                        Cancel

                    </a>

                    <button type="submit"
                            class="submit-btn">

                        Submit for Review

                    </button>

                </div>

            </div>

        </div>

        <div class="premium-card">

            <h3>
                Campaign Readiness Guide
            </h3>

            <div class="guide-card">

                <div class="guide-item">

                    <div class="guide-icon">
                        1
                    </div>

                    <div>

                        <strong>
                            Clear Objective
                        </strong>

                        <span>
                            Explain the purpose of the campaign and what problem it solves.
                        </span>

                    </div>

                </div>

                <div class="guide-item">

                    <div class="guide-icon">
                        2
                    </div>

                    <div>

                        <strong>
                            Emotional Storytelling
                        </strong>

                        <span>
                            Create meaningful storytelling so donors understand the urgency and impact.
                        </span>

                    </div>

                </div>

                <div class="guide-item">

                    <div class="guide-icon">
                        3
                    </div>

                    <div>

                        <strong>
                            Beneficiary Impact
                        </strong>

                        <span>
                            State who will benefit and how many people the campaign aims to support.
                        </span>

                    </div>

                </div>

                <div class="guide-item">

                    <div class="guide-icon">
                        4
                    </div>

                    <div>

                        <strong>
                            Professional Poster
                        </strong>

                        <span>
                            Upload a poster that represents the campaign and builds donor trust.
                        </span>

                    </div>

                </div>

                <div class="guide-item">

                    <div class="guide-icon">
                        5
                    </div>

                    <div>

                        <strong>
                            Transparent Funding Goal
                        </strong>

                        <span>
                            Set a realistic funding target that can later be linked to budget allocation and expenses.
                        </span>

                    </div>

                </div>

                <div class="guide-item">

                    <div class="guide-icon">
                        6
                    </div>

                    <div>

                        <strong>
                            Admin Approval
                        </strong>

                        <span>
                            Only approved campaigns can receive donations from public users.
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection