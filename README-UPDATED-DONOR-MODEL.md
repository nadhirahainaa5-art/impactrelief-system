# NGO Fund System - Updated Donor Model

This updated version follows the final self-register donor structure:

- Donor creates own account
- Staff never create donor accounts
- Staff manages donation processing / verification
- Admin manages governance, campaign control, approvals, and audit access

## Main changes included

1. Donor registration now creates:
   - `users.role = donor`
   - linked donor profile in `donors.user_id`

2. Professional role-based navigation bar:
   - straight single-line desktop menu
   - different links for admin, staff, and donor

3. Route access updated:
   - donor-only online donation flow
   - donor-only personal donation view
   - staff/admin back-office transaction pages
   - donor directory is no longer create-first workflow

4. Profile page updated for donor self-service editing

5. New migration added:
   - `2026_04_19_000001_link_donors_to_users_for_self_registration.php`

## Important note

This version keeps most of the original project structure, but refocuses the system around the new donor model requested by the user.


## Latest role correction
- Admin: governance, campaign control, fund allocation approval, expense approval, audit visibility.
- Staff: donation recording and verification, donor read-only access, expense submission only.
- Donor: self-register, donate, and track own records only.
