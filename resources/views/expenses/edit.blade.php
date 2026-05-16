@extends('layouts.app')

@section('title', 'Edit Expense Claim')
@section('page_title', 'Edit Expense Claim')

@section('content')

<style>
    .claim-hero {
        background: linear-gradient(135deg, #052e1b, #0f9f55);
        color: white;
        border-radius: 34px;
        padding: 34px;
        margin-bottom: 26px;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
        box-shadow: 0 24px 55px rgba(6, 59, 35, .20);
    }

    .claim-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
    }

    .claim-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 780px;
    }

    .claim-hero .eyebrow {
        color: #bbf7d0;
        letter-spacing: .14em;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .back-btn {
        background: white;
        color: #08783f;
        padding: 13px 20px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
        white-space: nowrap;
    }

    .claim-layout {
        display: grid;
        grid-template-columns: .85fr 1.15fr;
        gap: 24px;
    }

    .claim-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .section-title {
        margin: 0 0 18px;
        color: #0b1f16;
        font-size: 24px;
    }

    .admin-note {
        background: #fff7ed;
        color: #9a3412;
        border: 1px solid #fed7aa;
        border-radius: 22px;
        padding: 18px;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .control-rule {
        background: #f8fcfa;
        color: #475569;
        border: 1px solid #e3f1e8;
        border-radius: 22px;
        padding: 18px;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .budget-preview {
        display: grid;
        gap: 14px;
    }

    .budget-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
    }

    .budget-box span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .budget-box strong {
        color: #08783f;
        font-size: 22px;
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
    .premium-field select,
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
    .premium-field select:focus,
    .premium-field textarea:focus {
        border-color: #08783f;
        box-shadow: 0 0 0 4px rgba(8,120,63,.08);
    }

    .premium-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .error-box {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 20px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .submit-panel {
        margin-top: 22px;
        background: linear-gradient(135deg, #0b7a3b, #22c55e);
        border-radius: 28px;
        padding: 24px;
        color: white;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
    }

    .submit-panel h3 {
        margin: 0 0 6px;
        color: white;
    }

    .submit-panel p {
        margin: 0;
        color: #dcfce7;
    }

    .submit-btn {
        border: none;
        background: white;
        color: #08783f;
        padding: 15px 24px;
        border-radius: 999px;
        font-weight: 900;
        cursor: pointer;
        white-space: nowrap;
    }

    @media(max-width: 900px) {
        .claim-layout,
        .premium-grid {
            grid-template-columns: 1fr;
        }

        .claim-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .submit-panel {
            flex-direction: column;
            align-items: flex-start;
        }

        .submit-btn {
            width: 100%;
        }
    }
</style>

<div class="claim-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF CLAIM REVISION</p>
        <h1>Edit Expense Claim</h1>
        <p>
            Update this expense claim and resubmit it for administrator review.
            The claim must remain within the approved budget allocation balance.
        </p>
    </div>

    <a href="{{ route('expenses.show', $expense) }}" class="back-btn">
        Back to Claim
    </a>
</div>

@if($expense->review_comment)
    <div class="admin-note">
        <strong>Admin Review Comment:</strong><br>
        {{ $expense->review_comment }}
    </div>
@endif

@if ($errors->any())
    <div class="error-box">
        <strong>Please check your claim:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('expenses.update', $expense) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="claim-layout">

        <div class="claim-card">
            <h3 class="section-title">Budget Control</h3>

            <div class="control-rule">
                <strong>Revision rule:</strong><br>
                Choose an approved budget allocation and make sure the revised claim
                does not exceed the remaining allocation balance.
            </div>

            <div class="budget-preview">
                <div class="budget-box">
                    <span>Selected Approved Budget</span>
                    <strong id="approvedBudget">RM0.00</strong>
                </div>

                <div class="budget-box">
                    <span>Already Approved Claims</span>
                    <strong id="usedBudget">RM0.00</strong>
                </div>

                <div class="budget-box">
                    <span>Remaining Claimable Balance</span>
                    <strong id="remainingBudget">RM0.00</strong>
                </div>
            </div>
        </div>

        <div class="claim-card">
            <h3 class="section-title">Claim Revision Details</h3>

            <div class="premium-field">
                <label>Select Approved Budget Allocation</label>

                <select name="fund_allocation_id" id="allocationSelect" required>
                    <option value="">Choose approved allocation</option>

                    @foreach($approvedAllocations as $allocation)
                        @php
                            $approvedUsed = \App\Models\Expense::where('fund_allocation_id', $allocation->id)
                                ->where('status', 'approved')
                                ->where('id', '!=', $expense->id)
                                ->sum('amount');

                            $remaining = $allocation->amount - $approvedUsed;
                        @endphp

                        <option value="{{ $allocation->id }}"
                                data-budget="{{ $allocation->amount }}"
                                data-used="{{ $approvedUsed }}"
                                data-remaining="{{ $remaining }}"
                                {{ old('fund_allocation_id', $expense->fund_allocation_id) == $allocation->id ? 'selected' : '' }}>
                            {{ $allocation->campaign->title ?? 'Campaign Deleted' }}
                            — {{ $allocation->purpose->name ?? 'General Purpose' }}
                            — RM{{ number_format($remaining, 2) }} remaining
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="premium-grid">
                <div class="premium-field">
                    <label>Claim Amount (RM)</label>
                    <input type="number"
                           name="amount"
                           min="1"
                           step="0.01"
                           value="{{ old('amount', $expense->amount) }}"
                           required>
                </div>

                <div class="premium-field">
                    <label>Expense Purpose</label>
                    <select name="expense_type" required>
                        <option value="">Choose purpose</option>

                        @foreach([
                            'Food Supply',
                            'Transport & Logistics',
                            'Medical Aid',
                            'Temporary Shelter',
                            'Utilities',
                            'Equipment',
                            'Printing & Media',
                            'Volunteer Support',
                            'Others'
                        ] as $type)
                            <option value="{{ $type }}"
                                {{ old('expense_type', $expense->expense_type) == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="premium-grid">
                <div class="premium-field">
                    <label>Expense Date</label>
                    <input type="date"
                           name="expense_date"
                           value="{{ old('expense_date', optional($expense->expense_date)->format('Y-m-d')) }}"
                           required>
                </div>

                <div class="premium-field">
                    <label>Vendor / Supplier</label>
                    <input type="text"
                           name="vendor"
                           value="{{ old('vendor', $expense->vendor) }}"
                           placeholder="Example: Kedai Runcit Aman">
                </div>
            </div>

            <div class="premium-field">
                <label>Replace Receipt</label>
                <input type="file" name="receipt" accept="image/*,.pdf">
            </div>

            <div class="premium-field">
                <label>Claim Description</label>
                <textarea name="description"
                          rows="4"
                          placeholder="Explain what this claim is for...">{{ old('description', $expense->description) }}</textarea>
            </div>

            <div class="submit-panel">
                <div>
                    <h3>Resubmit updated claim?</h3>
                    <p>The claim status will return to pending for admin review.</p>
                </div>

                <button type="submit" class="submit-btn">
                    Update & Resubmit
                </button>
            </div>
        </div>

    </div>

</form>

<script>
    const allocationSelect = document.getElementById('allocationSelect');
    const approvedBudget = document.getElementById('approvedBudget');
    const usedBudget = document.getElementById('usedBudget');
    const remainingBudget = document.getElementById('remainingBudget');

    function formatRM(value) {
        return 'RM' + Number(value || 0).toLocaleString('en-MY', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateBudgetPreview() {
        const option = allocationSelect.options[allocationSelect.selectedIndex];

        approvedBudget.textContent = formatRM(option.dataset.budget || 0);
        usedBudget.textContent = formatRM(option.dataset.used || 0);
        remainingBudget.textContent = formatRM(option.dataset.remaining || 0);
    }

    allocationSelect.addEventListener('change', updateBudgetPreview);
    updateBudgetPreview();
</script>

@endsection