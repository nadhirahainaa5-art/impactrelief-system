@extends('layouts.app')

@section('title', 'Donate Now')
@section('page_title', 'Donate Now')

@section('content')

<div class="page-header">
    <div>
        <p class="eyebrow">Secure Donation Gateway</p>
        <h1>Support A Campaign</h1>
        <p class="muted">
            Choose campaign, enter amount and complete payment securely.
        </p>
    </div>

    <div class="toolbar">
        <a href="{{ route('donor.dashboard') }}" class="btn-secondary">
            Back
        </a>
    </div>
</div>

<form method="POST"
      action="{{ route('public-donations.store') }}"
      class="form-shell">

    @csrf

    <div class="field">
        <label>Select Campaign</label>

        <select name="campaign_id" required>
            <option value="">Choose Campaign</option>

            @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}"
                    {{ old('campaign_id', $selectedCampaign) == $campaign->id ? 'selected' : '' }}>
                    {{ $campaign->title }} (RM{{ number_format($campaign->funding_goal, 2) }})
                </option>
            @endforeach
        </select>

        @error('campaign_id')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="grid-two">

        <div class="field">
            <label>Donation Amount (RM)</label>

            <input type="number"
                   name="amount"
                   min="1"
                   step="0.01"
                   value="{{ old('amount') }}"
                   required>

            @error('amount')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="field">
            <label>Payment Method</label>

            <select name="payment_method"
                    id="payment_method"
                    onchange="toggleBank()"
                    required>

                <option value="">Choose Method</option>
                <option value="FPX" {{ old('payment_method') == 'FPX' ? 'selected' : '' }}>FPX</option>
                <option value="Online Banking" {{ old('payment_method') == 'Online Banking' ? 'selected' : '' }}>Online Banking</option>
                <option value="Debit Card" {{ old('payment_method') == 'Debit Card' ? 'selected' : '' }}>Debit Card</option>
                <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>

            @error('payment_method')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

    </div>

    <div class="field" id="bank_box" style="display:none;">
        <label>Select Bank / Payment Gateway</label>

        <select name="bank_name">
            <option value="">Choose Bank</option>
            <option {{ old('bank_name') == 'Maybank' ? 'selected' : '' }}>Maybank</option>
            <option {{ old('bank_name') == 'CIMB Bank' ? 'selected' : '' }}>CIMB Bank</option>
            <option {{ old('bank_name') == 'Public Bank' ? 'selected' : '' }}>Public Bank</option>
            <option {{ old('bank_name') == 'RHB Bank' ? 'selected' : '' }}>RHB Bank</option>
            <option {{ old('bank_name') == 'Hong Leong Bank' ? 'selected' : '' }}>Hong Leong Bank</option>
            <option {{ old('bank_name') == 'AmBank' ? 'selected' : '' }}>AmBank</option>
            <option {{ old('bank_name') == 'Bank Islam' ? 'selected' : '' }}>Bank Islam</option>
            <option {{ old('bank_name') == 'Bank Muamalat' ? 'selected' : '' }}>Bank Muamalat</option>
            <option {{ old('bank_name') == 'BSN' ? 'selected' : '' }}>BSN</option>
            <option {{ old('bank_name') == 'Affin Bank' ? 'selected' : '' }}>Affin Bank</option>
            <option {{ old('bank_name') == 'UOB Malaysia' ? 'selected' : '' }}>UOB Malaysia</option>
            <option {{ old('bank_name') == 'OCBC Bank' ? 'selected' : '' }}>OCBC Bank</option>
            <option {{ old('bank_name') == 'HSBC Malaysia' ? 'selected' : '' }}>HSBC Malaysia</option>
            <option {{ old('bank_name') == 'Standard Chartered' ? 'selected' : '' }}>Standard Chartered</option>
        </select>

        @error('bank_name')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="content-card section-gap">
        <h3 style="margin-top:0;">Donation Summary</h3>

        <p class="muted" style="margin-bottom:0;">
            Your donation helps approved NGO campaigns directly.
            Every transaction is recorded transparently and receipt will be generated after payment.
        </p>
    </div>

    <div class="toolbar section-gap">
        <button type="submit" class="btn">
            Complete Donation
        </button>

        <a href="{{ route('donor.dashboard') }}"
           class="btn-secondary">
            Cancel
        </a>
    </div>

</form>

<script>
function toggleBank()
{
    const method = document.getElementById('payment_method').value;
    const box = document.getElementById('bank_box');

    if (method === 'FPX' || method === 'Online Banking') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', toggleBank);
</script>

@endsection