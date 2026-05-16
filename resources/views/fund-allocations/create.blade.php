@extends('layouts.app')

@section('title', 'Create Budget Request')
@section('page_title', 'Create Budget Request')

@section('content')

<style>
    .budget-hero {
        background: linear-gradient(135deg, #052e1b, #0f9f55);
        color: white;
        border-radius: 34px;
        padding: 34px;
        margin-bottom: 26px;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
        box-shadow: 0 24px 55px rgba(6, 59, 35, .20);
    }

    .budget-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
    }

    .budget-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 820px;
    }

    .budget-hero .eyebrow {
        color: #bbf7d0;
        letter-spacing: .14em;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .back-btn {
        background: white;
        color: #08783f;
        padding: 13px 20px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
        white-space: nowrap;
    }

    .budget-layout {
        display: grid;
        grid-template-columns: .85fr 1.15fr;
        gap: 24px;
    }

    .budget-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .section-title {
        margin: 0 0 18px;
        color: #0b1f16;
        font-size: 24px;
    }

    .control-rule {
        background: #fff7ed;
        color: #9a3412;
        border: 1px solid #fed7aa;
        border-radius: 22px;
        padding: 18px;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .workflow-list {
        display: grid;
        gap: 14px;
    }

    .workflow-item {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
    }

    .workflow-item strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 6px;
    }

    .workflow-item span {
        color: #64748b;
        line-height: 1.6;
        font-size: 14px;
    }

    .premium-field {
        margin-bottom: 18px;
    }

    .premium-field label {
        display: block;
        margin-bottom: 8px;
        font-weight: 900;
        color: #0b1f16;
    }

    .premium-field input,
    .premium-field select,
    .premium-field textarea {
        width: 100%;
        border: 1px solid #cbd8d0;
        border-radius: 18px;
        padding: 15px 17px;
        font-size: 15px;
        outline: none;
        transition: .2s ease;
        background: white;
    }

    .premium-field input:focus,
    .premium-field select:focus,
    .premium-field textarea:focus {
        border-color: #08783f;
        box-shadow: 0 0 0 4px rgba(8,120,63,.08);
    }

    .premium-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .campaign-preview {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .preview-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
    }

    .preview-box span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .preview-box strong {
        color: #08783f;
        font-size: 20px;
    }

    .submit-panel {
        margin-top: 22px;
        background: linear-gradient(135deg, #0b7a3b, #22c55e);
        border-radius: 28px;
        padding: 24px;
        color: white;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
    }

    .submit-panel h3 {
        margin: 0 0 6px;
        color: white;
    }

    .submit-panel p {
        margin: 0;
        color: #dcfce7;
    }

    .submit-btn {
        border: none;
        background: white;
        color: #08783f;
        padding: 15px 24px;
        border-radius: 999px;
        font-weight: 900;
        cursor: pointer;
        white-space: nowrap;
    }

    @media(max-width: 900px) {
        .budget-layout,
        .premium-grid,
        .campaign-preview {
            grid-template-columns: 1fr;
        }

        .budget-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .budget-hero h1 {
            font-size: 32px;
        }

        .submit-panel {
            flex-direction: column;
            align-items: flex-start;
        }

        .submit-btn {
            width: 100%;
        }
    }
</style>

<div class="budget-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF BUDGET REQUEST</p>
        <h1>Create Budget Allocation Request</h1>
        <p>
            Submit a budget request for a specific campaign purpose. Once approved by admin,
            this budget becomes the spending limit for future expense claims.
        </p>
    </div>

    <a href="{{ route('fund-allocations.index') }}" class="back-btn">
        Back to Budget Centre
    </a>
</div>

<form method="POST"
      action="{{ route('fund-allocations.store') }}">

    @csrf

    <div class="budget-layout">

        <div class="budget-card">
            <h3 class="section-title">Budget Governance Rule</h3>

            <div class="control-rule">
                <strong>Important:</strong><br>
                This request does not mean money has been spent. It only reserves an approved budget.
                Actual usage happens later through expense claims.
            </div>

            <div class="workflow-list">
                <div class="workflow-item">
                    <strong>1. Staff creates budget request</strong>
                    <span>Choose campaign, purpose and requested allocation amount.</span>
                </div>

                <div class="workflow-item">
                    <strong>2. Admin reviews request</strong>
                    <span>Admin can approve, reject or request revision with comments.</span>
                </div>

                <div class="workflow-item">
                    <strong>3. Staff submits expense claim</strong>
                    <span>Only approved budgets can be used for expense claims.</span>
                </div>

                <div class="workflow-item">
                    <strong>4. System controls spending</strong>
                    <span>Expense claims cannot exceed remaining approved allocation balance.</span>
                </div>
            </div>
        </div>

        <div class="budget-card">
            <h3 class="section-title">Budget Request Details</h3>

            <div class="premium-field">
                <label>Select Campaign</label>

                <select name="campaign_id" id="campaignSelect" required>
                    <option value="">Choose approved campaign</option>

                    @foreach($campaigns as $campaign)
                        @php
                            $raised = $campaign->amount_raised ?? 0;
                            $used = $campaign->amount_used ?? 0;
                            $available = max($raised - $used, 0);
                        @endphp

                        <option value="{{ $campaign->id }}"
                                data-goal="{{ $campaign->funding_goal ?? 0 }}"
                                data-raised="{{ $raised }}"
                                data-used="{{ $used }}"
                                data-available="{{ $available }}"
                                {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                            {{ $campaign->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campaign-preview">
                <div class="preview-box">
                    <span>Funding Goal</span>
                    <strong id="goalPreview">RM0.00</strong>
                </div>

                <div class="preview-box">
                    <span>Amount Raised</span>
                    <strong id="raisedPreview">RM0.00</strong>
                </div>

                <div class="preview-box">
                    <span>Available Balance</span>
                    <strong id="availablePreview">RM0.00</strong>
                </div>
            </div>

            <div class="premium-grid">
                <div class="premium-field">
                    <label>Requested Budget Amount (RM)</label>

                    <input type="number"
                           name="amount"
                           min="1"
                           step="0.01"
                           value="{{ old('amount') }}"
                           required>
                </div>

                <div class="premium-field">
                    <label>Budget Purpose</label>

                    <select name="purpose_id" required>
                        <option value="">Choose budget purpose</option>

                        @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}"
                                {{ old('purpose_id') == $purpose->id ? 'selected' : '' }}>
                                {{ $purpose->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="premium-field">
                <label>Budget Justification</label>

                <textarea name="note"
                          rows="5"
                          placeholder="Explain why this budget is needed and how it will support the campaign...">{{ old('note') }}</textarea>
            </div>

            <div class="submit-panel">
                <div>
                    <h3>Submit budget request?</h3>
                    <p>Admin will review before this budget can be used for expense claims.</p>
                </div>

                <button type="submit" class="submit-btn">
                    Submit Budget Request
                </button>
            </div>
        </div>

    </div>
</form>

<script>
    const campaignSelect = document.getElementById('campaignSelect');
    const goalPreview = document.getElementById('goalPreview');
    const raisedPreview = document.getElementById('raisedPreview');
    const availablePreview = document.getElementById('availablePreview');

    function formatRM(value) {
        return 'RM' + Number(value || 0).toLocaleString('en-MY', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateCampaignPreview() {
        const option = campaignSelect.options[campaignSelect.selectedIndex];

        goalPreview.textContent = formatRM(option.dataset.goal || 0);
        raisedPreview.textContent = formatRM(option.dataset.raised || 0);
        availablePreview.textContent = formatRM(option.dataset.available || 0);
    }

    campaignSelect.addEventListener('change', updateCampaignPreview);
    updateCampaignPreview();
</script>

@endsection