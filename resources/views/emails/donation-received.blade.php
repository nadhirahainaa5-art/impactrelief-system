<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Receipt</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f8fafc; padding:24px; color:#1e293b;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:16px; padding:32px; border:1px solid #e2e8f0;">
        <p style="margin-top:0; color:#0f766e; font-weight:700;">Thank you for your contribution</p>
        <h2 style="margin:0 0 16px;">Donation receipt confirmation</h2>
        <p>Dear {{ $donation->donor->full_name ?? 'Donor' }},</p>
        <p>We have successfully recorded your donation in our NGO Fund Management System prototype.</p>

        <table style="width:100%; border-collapse:collapse; margin:20px 0;">
            <tr><td style="padding:8px 0; font-weight:700;">Receipt Number</td><td>{{ $donation->receipt_number }}</td></tr>
            <tr><td style="padding:8px 0; font-weight:700;">Transaction Reference</td><td>{{ $donation->transaction_reference ?? '-' }}</td></tr>
            <tr><td style="padding:8px 0; font-weight:700;">Amount</td><td>RM {{ number_format($donation->amount, 2) }}</td></tr>
            <tr><td style="padding:8px 0; font-weight:700;">Payment Method</td><td>{{ $donation->payment_method }}</td></tr>
            <tr><td style="padding:8px 0; font-weight:700;">Gateway</td><td>{{ $donation->payment_gateway ?? '-' }}</td></tr>
            <tr><td style="padding:8px 0; font-weight:700;">Date</td><td>{{ optional($donation->donation_date)->format('d M Y') }}</td></tr>
        </table>

        <p>This email template is included as a sample deliverable for your prototype.</p>
        <p style="margin-bottom:0;">Regards,<br>NGO Fund Management Team</p>
    </div>
</body>
</html>
