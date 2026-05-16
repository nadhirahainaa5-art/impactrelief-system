<x-guest-layout>

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
        .title-wrap {
            text-align: center;
            margin-bottom: 24px;
        }

        .title-wrap h2 {
            margin: 0;
            font-size: 28px;
            color: #0f172a;
        }

        .title-wrap p {
            margin: 8px 0 0;
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
        }

        .form-control {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 18px;
            padding: 14px 16px;
            font-size: 14px;
            color: #0f172a;
            background: #ffffff;
            outline: none;
            transition: 0.2s ease;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.14);
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .remember-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
        }

        .remember-wrap input[type="checkbox"] {
            accent-color: #16a34a;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 18px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #16a34a, #10b981);
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
            box-shadow: 0 12px 24px rgba(16, 185, 129, 0.22);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            filter: brightness(0.98);
        }

        .bottom-links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .bottom-links a,
        .inline-link {
            color: #15803d;
            text-decoration: none;
            font-weight: 700;
        }

        .bottom-links a:hover,
        .inline-link:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 16px;
            font-size: 14px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .field-error {
            margin-top: 8px;
            font-size: 13px;
            color: #dc2626;
        }

        @media (max-width: 480px) {
            .form-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="title-wrap">
        <h2>Staff & Admin Portal</h2>

<p>
    Login to manage campaigns, donations,
    approvals, allocations and reports.
</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email"
                class="form-control"
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
                class="form-control"
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <label for="remember_me" class="remember-wrap">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="inline-link">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary">
            Sign In to Dashboard
        </button>
    </form>

    <div class="bottom-links">

    <div style="margin-bottom:10px;">
        Secure access for authorized staff and administrators only.
    </div>

    <a href="{{ route('home') }}">
        ← Back to Donation Website
    </a>

</div>

</x-guest-layout>