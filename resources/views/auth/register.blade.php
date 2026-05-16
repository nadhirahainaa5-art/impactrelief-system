<x-guest-layout>
    <style>
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

        .field-error {
            margin-top: 8px;
            font-size: 13px;
            color: #dc2626;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 18px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #16a34a, #10b981);
            color: white;
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

        .bottom-link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .bottom-link a {
            color: #15803d;
            text-decoration: none;
            font-weight: 700;
        }

        .bottom-link a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="title-wrap">
        <h2>Create Donor Account</h2>
        <p>Register to start donating and tracking your records</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                placeholder="Enter your full name"
                class="form-control"
            >
            @error('name')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="Enter your email"
                class="form-control"
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
                placeholder="Enter your password"
                class="form-control"
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
                placeholder="Confirm your password"
                class="form-control"
            >
        </div>

        <button type="submit" class="btn-primary">Sign Up</button>
    </form>

    <div class="bottom-link">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</x-guest-layout>