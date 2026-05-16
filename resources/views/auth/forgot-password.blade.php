<x-guest-layout>

<style>
.title{text-align:center;margin-bottom:24px}
.title h2{margin:0;font-size:28px;color:#0f172a}
.title p{margin:8px 0 0;font-size:14px;color:#64748b;line-height:1.6}

.group{margin-bottom:18px}
.group label{
display:block;
margin-bottom:8px;
font-size:14px;
font-weight:700;
color:#334155;
}

.input{
width:100%;
border:1px solid #cbd5e1;
border-radius:18px;
padding:14px 16px;
font-size:14px;
outline:none;
transition:.2s ease;
}

.input:focus{
border-color:#22c55e;
box-shadow:0 0 0 4px rgba(34,197,94,.14);
}

.btn{
width:100%;
border:none;
border-radius:18px;
padding:14px 16px;
background:linear-gradient(135deg,#16a34a,#10b981);
color:#fff;
font-weight:800;
cursor:pointer;
transition:.2s ease;
box-shadow:0 12px 24px rgba(16,185,129,.22);
}

.btn:hover{
transform:translateY(-1px);
filter:brightness(.98);
}

.status{
margin-bottom:18px;
padding:12px 14px;
background:#f0fdf4;
border:1px solid #bbf7d0;
border-radius:16px;
color:#166534;
font-size:14px;
}

.back{
margin-top:20px;
text-align:center;
font-size:14px;
}

.back a{
color:#15803d;
font-weight:700;
text-decoration:none;
}

.back a:hover{
text-decoration:underline;
}
</style>

<div class="title">
    <h2>Forgot Password</h2>
    <p>Enter your email and we’ll send reset link</p>
</div>

@if (session('status'))
<div class="status">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
@csrf

<div class="group">
    <label>Email Address</label>
    <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
        class="input"
        placeholder="Enter your email"
    >
</div>

<button type="submit" class="btn">
    Send Reset Link
</button>

</form>

<div class="back">
    <a href="{{ route('login') }}">
        ← Turn Back to Login
    </a>
</div>

</x-guest-layout>