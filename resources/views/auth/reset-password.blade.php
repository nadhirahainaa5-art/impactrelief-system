<x-guest-layout>

<style>
.title{text-align:center;margin-bottom:24px}
.title h2{margin:0;font-size:28px;color:#0f172a}
.group{margin-bottom:18px}
.group label{display:block;margin-bottom:8px;font-size:14px;font-weight:700;color:#334155}
.input{
width:100%;border:1px solid #cbd5e1;border-radius:18px;
padding:14px 16px;font-size:14px;outline:none;
}
.input:focus{
border-color:#22c55e;
box-shadow:0 0 0 4px rgba(34,197,94,.14);
}
.btn{
width:100%;border:none;border-radius:18px;
padding:14px 16px;
background:linear-gradient(135deg,#16a34a,#10b981);
color:#fff;font-weight:800;
cursor:pointer;
}
</style>

<div class="title">
<h2>Reset Password</h2>
</div>

<form method="POST" action="{{ route('password.store') }}">
@csrf

<input type="hidden" name="token" value="{{ $request->route('token') }}">

<div class="group">
<label>Email</label>
<input type="email" name="email" value="{{ old('email', $request->email) }}" class="input" required>
</div>

<div class="group">
<label>New Password</label>
<input type="password" name="password" class="input" required>
</div>

<div class="group">
<label>Confirm Password</label>
<input type="password" name="password_confirmation" class="input" required>
</div>

<button class="btn">Reset Password</button>

</form>

</x-guest-layout>