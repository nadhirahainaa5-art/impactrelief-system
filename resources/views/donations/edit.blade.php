@extends('layouts.app')

@section('title', 'Edit Donation')

@section('content')
    <h1>Edit Donation</h1>

    <div class="panel">
        <form action="{{ route('donations.update', $donation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid two-col">
                <div class="form-group">
                    <label>Donor</label>
                    <select name="donor_id" class="form-control" required>
                        @foreach($donors as $donor)
                            <option value="{{ $donor->id }}" {{ $donor->id == $donation->donor_id ? 'selected' : '' }}>
                                {{ $donor->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Purpose</label>
                    <select name="purpose_id" class="form-control">
                        <option value="">Select Purpose</option>
                        @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}" {{ $purpose->id == $donation->purpose_id ? 'selected' : '' }}>
                                {{ $purpose->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Campaign</label>
                    <select name="campaign_id" class="form-control">
                        <option value="">Select Campaign</option>
                        @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ $campaign->id == $donation->campaign_id ? 'selected' : '' }}>
                                {{ $campaign->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ $donation->amount }}" required>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" class="form-control" required>
                        @foreach(['Cash', 'Bank Transfer', 'Cheque', 'Online Payment'] as $method)
                            <option value="{{ $method }}" @selected($donation->payment_method === $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Payment Gateway</label>
                    <select name="payment_gateway" class="form-control">
                        <option value="">Not applicable</option>
                        @foreach(['ToyyibPay Simulation', 'Stripe Simulation', 'Manual Online Transfer'] as $gateway)
                            <option value="{{ $gateway }}" @selected($donation->payment_gateway === $gateway)>{{ $gateway }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Donation Date</label>
                    <input type="date" name="donation_date" class="form-control" value="{{ $donation->donation_date?->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control" required>
                        <option value="one-time" {{ $donation->type == 'one-time' ? 'selected' : '' }}>One-time</option>
                        <option value="recurring" {{ $donation->type == 'recurring' ? 'selected' : '' }}>Recurring</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Receipt Number</label>
                    <input type="text" name="receipt_number" class="form-control" value="{{ $donation->receipt_number }}">
                </div>

                <div class="form-group">
                    <label>Replace Receipt File</label>
                    <input type="file" name="receipt_file" class="form-control">
                    @if($donation->receipt_path)
                        <small><a href="{{ asset('storage/' . $donation->receipt_path) }}" target="_blank">Current uploaded file</a></small>
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        @foreach(['draft', 'pending', 'approved', 'rejected'] as $status)
                            <option value="{{ $status }}" @selected($donation->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Note</label>
                    <textarea name="note" class="form-control">{{ $donation->note }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn">Update</button>
        </form>
    </div>
@endsection
