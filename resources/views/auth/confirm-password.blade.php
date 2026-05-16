<x-guest-layout>

<style>
.title{text-align:center;margin-bottom:24px}
.title h2{font-size:28px;margin:0}
.group{margin-bottom:18px}
.group label{display:block;margin-bottom:8px;font-weight:700}
.input{
width:100%;border:1px solid #cbd5e1;border-radius:18px;
padding:14px 16px;
}
.btn{
width:100%;border:none;border-radius:18px;
padding:14px 16px;
background:linear-gradient(135deg,#16a34a,#10b981);
color:#fff;font-weight:800;
}
</style>

<div class="title">
<h2>Confirm Password</h2>
</div>

<form method="POST" action="{{ route('password.confirm') }}">
@csrf

<div class="group">
<label>Password</label>
<input type="password" name="password" class="input" required>
</div>

<button class="btn">Confirm</button>

</form>

</x-guest-layout>