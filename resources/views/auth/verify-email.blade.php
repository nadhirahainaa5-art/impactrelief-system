<x-guest-layout>

<style>
.wrap{text-align:center}
.wrap h2{font-size:28px;color:#0f172a;margin:0}
.wrap p{margin-top:10px;color:#64748b;font-size:14px;line-height:1.7}
.btn{
margin-top:24px;
width:100%;border:none;border-radius:18px;
padding:14px 16px;
background:linear-gradient(135deg,#16a34a,#10b981);
color:#fff;font-weight:800;cursor:pointer;
}
.link{
display:block;margin-top:18px;
color:#15803d;font-weight:700;
text-decoration:none;
}
</style>

<div class="wrap">
<h2>Verify Email</h2>

<p>
Please verify your email by clicking the link sent to your inbox.
</p>

<form method="POST" action="{{ route('verification.send') }}">
@csrf
<button class="btn">Resend Verification Email</button>
</form>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="link">Logout</button>
</form>

</div>

</x-guest-layout>