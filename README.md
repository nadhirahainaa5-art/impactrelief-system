# NGO Fund Management System Prototype

Laravel-based prototype for transparent donation fund management. This updated version keeps the original project structure and adds:

- online donation simulation
- uploaded receipt support
- sample email template
- sample uploaded files
- API route examples
- clean traceability flow for assignment / MVP demo

## Main Modules

- Authentication (Laravel Breeze style)
- Dashboard
- Donor Management
- Donation Management
- Online Donation Simulation
- Campaign Management
- Purpose Management
- Fund Allocation
- Expense Management
- Audit Log

## Updated Setup Steps

1. Start Apache & MySQL in XAMPP.
2. Create a new database in phpMyAdmin, for example: `ngo_fund_system`.
3. Configure `.env`:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=ngo_fund_system`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
4. Run:
   ```bash
   php artisan migrate --seed
   ```
5. Create storage link:
   ```bash
   php artisan storage:link
   ```
6. Run:
   ```bash
   php artisan serve
   ```
7. Access system:
   - Staff system: `http://127.0.0.1:8000/login`
   - Online donation simulation: `http://127.0.0.1:8000/donate-online`
8. Login with admin:
   - Email: `admin@ngo.com`
   - Password: `password123`

## Sample Files Included

- `storage/app/public/sample-receipts/sample-receipt-demo-001.txt`
- `storage/app/public/sample-uploads/beneficiary-summary-demo.txt`

## Sample Email Template

- `resources/views/emails/donation-received.blade.php`
- `app/Mail/DonationReceivedMail.php`

## API Route Examples

### Get all campaigns
```http
GET /api/campaigns
```

### Simulate online donation
```http
POST /api/donations/simulate
Content-Type: application/json

{
  "full_name": "Demo Donor",
  "email": "demo@example.com",
  "amount": 150,
  "purpose_id": 1,
  "campaign_id": 1,
  "payment_gateway": "ToyyibPay Simulation"
}
```

## Important Implementation Notes

- Keep system simple but functional.
- Payment logic is basic simulation only, without complex webhook flow.
- Focus is on working flow, clean UI, and data traceability.
- Uploaded receipt is stored in Laravel public storage.
- Online donation creates transaction reference and receipt number automatically.

## Suggested Demo Flow

1. Login as admin.
2. Review existing seeded donors, campaigns, donations, and allocations.
3. Open `/donate-online`.
4. Submit a simulated online donation.
5. Upload a receipt/proof file.
6. Check the donation list and confirm traceability.
7. Open the uploaded file from the donations table.

## Database Change Added

A new migration extends the existing `donations` table with:

- `is_online`
- `payment_gateway`
- `transaction_reference`
- `receipt_path`

This keeps your old database structure and only adds the new required features.
