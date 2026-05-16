@extends('layouts.app')

@section('title', 'Account Centre')
@section('page_title', 'Account Centre')

@section('content')

<style>
    .profile-hero {
        background: linear-gradient(135deg, #052e1b, #0f9f55);
        border-radius: 34px;
        padding: 34px;
        color: white;
        box-shadow: 0 24px 55px rgba(6, 59, 35, .20);
        margin-bottom: 26px;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
    }

    .profile-hero h1 {
        margin: 0 0 10px;
        font-size: 42px;
        color: white;
        letter-spacing: -1px;
    }

    .profile-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
    }

    .profile-badge {
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 999px;
        padding: 12px 18px;
        font-weight: 900;
        white-space: nowrap;
    }

    .profile-layout {
        display: grid;
        grid-template-columns: .8fr 1.2fr;
        gap: 24px;
    }

    .profile-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .summary-card {
        position: sticky;
        top: 24px;
        align-self: start;
        text-align: center;
        overflow: hidden;
    }

    .avatar-large {
        width: 96px;
        height: 96px;
        margin: 0 auto 18px;
        border-radius: 30px;
        background: linear-gradient(135deg, #08783f, #22c55e);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 900;
        box-shadow: 0 18px 35px rgba(8,120,63,.2);
    }

    .summary-card h2 {
        margin: 0;
        color: #0b1f16;
        font-size: 26px;
    }

    .summary-card p {
        color: #64748b;
        margin: 8px 0 20px;
    }

    .role-pill {
        display: inline-flex;
        padding: 9px 16px;
        border-radius: 999px;
        background: #e8fbef;
        color: #08783f;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: .08em;
    }

    .summary-line {
        margin-top: 24px;
        text-align: left;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .summary-item {
        padding: 16px;
        border-radius: 20px;
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
    }

    .summary-item span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .summary-item strong {
        color: #0b1f16;
        font-size: 15px;
    }

    .form-section {
        margin-bottom: 22px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 44px;
        height: 44px;
        border-radius: 16px;
        background: #e8fbef;
        color: #08783f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .section-title h3 {
        margin: 0;
        font-size: 24px;
        color: #0b1f16;
    }

    .section-title p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .premium-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
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
    .premium-field textarea:focus {
        border-color: #08783f;
        box-shadow: 0 0 0 4px rgba(8,120,63,.08);
    }

    .security-note {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        padding: 15px 17px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.6;
    }

    .save-panel {
        margin-top: 24px;
        background: linear-gradient(135deg, #0b7a3b, #22c55e);
        border-radius: 28px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
        gap: 18px;
    }

    .save-panel h3 {
        margin: 0 0 6px;
        color: white;
    }

    .save-panel p {
        margin: 0;
        color: #dcfce7;
    }

    .save-btn {
        border: none;
        background: white;
        color: #08783f;
        border-radius: 999px;
        padding: 15px 24px;
        font-weight: 900;
        cursor: pointer;
        white-space: nowrap;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        padding: 16px 18px;
        border-radius: 20px;
        margin-bottom: 22px;
        font-weight: 800;
    }

    @media(max-width: 900px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }

        .profile-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .summary-card {
            position: static;
        }
    }

    @media(max-width: 620px) {
        .premium-grid {
            grid-template-columns: 1fr;
        }

        .profile-hero h1 {
            font-size: 32px;
        }

        .save-panel {
            flex-direction: column;
            align-items: flex-start;
        }

        .save-btn {
            width: 100%;
        }
    }
</style>

<div class="profile-hero">
    <div>
        <p class="eyebrow" style="color:#bbf7d0;">IMPACTRELIEF ACCOUNT CENTRE</p>
        <h1>Profile & Security Settings</h1>
        <p>
            Manage your staff account details, access identity and login security
            for the ImpactRelief operations platform.
        </p>
    </div>

    <div class="profile-badge">
        {{ strtoupper($user->role ?? 'USER') }} ACCOUNT
    </div>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

    <div class="profile-layout">

        <div class="profile-card summary-card">
            <div class="avatar-large">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>

            <span class="role-pill">
                {{ $user->role ?? 'staff' }}
            </span>

            <div class="summary-line">
                <div class="summary-item">
                    <span>Platform</span>
                    <strong>ImpactRelief Operations</strong>
                </div>

                <div class="summary-item">
                    <span>Access Level</span>
                    <strong>{{ ucfirst($user->role ?? 'Staff') }}</strong>
                </div>

                <div class="summary-item">
                    <span>Account Purpose</span>
                    <strong>Campaign, donation and relief management</strong>
                </div>
            </div>
        </div>

        <div>
            <div class="profile-card form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    <div>
                        <h3>Basic Information</h3>
                        <p>Update your account identity used across the system.</p>
                    </div>
                </div>

                <div class="premium-grid">
                    <div class="premium-field">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required>
                    </div>

                    <div class="premium-field">
                        <label>Email Address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required>
                    </div>
                </div>
            </div>

            @if($user->isDonor())
                <div class="profile-card form-section">
                    <div class="section-title">
                        <div class="section-icon">🤲</div>
                        <div>
                            <h3>Donor Details</h3>
                            <p>Additional donor profile information.</p>
                        </div>
                    </div>

                    <div class="premium-grid">
                        <div class="premium-field">
                            <label>Full Name</label>
                            <input type="text"
                                   name="full_name"
                                   value="{{ old('full_name', $donor->full_name ?? '') }}">
                        </div>

                        <div class="premium-field">
                            <label>Phone</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone', $donor->phone ?? '') }}">
                        </div>
                    </div>

                    <div class="premium-field">
                        <label>Address</label>
                        <textarea name="address" rows="4">{{ old('address', $donor->address ?? '') }}</textarea>
                    </div>

                    <div class="premium-field">
                        <label>Preferred Purpose</label>
                        <input type="text"
                               name="preferred_purpose"
                               value="{{ old('preferred_purpose', $donor->preferred_purpose ?? '') }}"
                               placeholder="Flood Relief / Education / Medical">
                    </div>
                </div>
            @endif

            <div class="profile-card form-section">
                <div class="section-title">
                    <div class="section-icon">🔐</div>
                    <div>
                        <h3>Security Settings</h3>
                        <p>Change your password only when needed.</p>
                    </div>
                </div>

                <div class="premium-grid">
                    <div class="premium-field">
                        <label>New Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current password">
                    </div>

                    <div class="premium-field">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password">
                    </div>
                </div>

                <div class="security-note">
                    For security purposes, use a strong password and avoid sharing
                    account credentials with other users.
                </div>
            </div>

            <div class="save-panel">
                <div>
                    <h3>Save account changes?</h3>
                    <p>Your updated information will be applied to your staff profile.</p>
                </div>

                <button type="submit" class="save-btn">
                    Save Changes
                </button>
            </div>
        </div>

    </div>
</form>

@endsection