@extends('layouts.app')

@section('title', 'Edit Campaign')
@section('page_title', 'Edit Campaign')

@section('content')

<div class="page-header">
    <div>
        <p class="eyebrow">Campaign Update</p>
        <h1>Edit Campaign</h1>
        <p class="muted">
            Update your campaign and resubmit for admin review.
        </p>
    </div>

    <div class="toolbar">
        <a href="{{ route('campaigns.index') }}" class="btn-secondary">Back</a>
    </div>
</div>

<form method="POST"
      action="{{ route('campaigns.update', $campaign) }}"
      enctype="multipart/form-data"
      class="form-shell">
    @csrf
    @method('PUT')

    <div class="field">
        <label>Campaign Title</label>
        <input type="text"
               name="title"
               value="{{ old('title', $campaign->title) }}"
               required>
    </div>
    <div class="field">
    <label>Campaign Tagline</label>

    <input type="text"
           name="tagline"
           value="{{ old('tagline', $campaign->tagline) }}"
           placeholder="Example: Help children rebuild their future.">
</div>

<div class="field">
    <label>Campaign Story</label>

    <textarea name="campaign_story"
              rows="8"
              placeholder="Write full campaign story...">{{ old('campaign_story', $campaign->campaign_story) }}</textarea>
</div>

<div class="field">
    <label>Donation Usage Plan</label>

    <textarea name="donation_usage"
              rows="5"
              placeholder="Explain how donations will be used...">{{ old('donation_usage', $campaign->donation_usage) }}</textarea>
</div>

<div class="field">
    <label>YouTube Campaign Video</label>

    <input type="text"
           name="youtube_url"
           value="{{ old('youtube_url', $campaign->youtube_url) }}"
           placeholder="https://www.youtube.com/embed/VIDEO_ID">
</div>

<div class="field">
    <label>Campaign Poster</label>

    <input type="file"
           name="poster"
           accept="image/*">

    @if($campaign->poster_path)
        <div style="margin-top:15px;">
            <img src="{{ asset('storage/' . $campaign->poster_path) }}"
                 style="width:220px; border-radius:14px;">
        </div>
    @endif
</div>

    <div class="field">
        <label>Description</label>
        <textarea name="description" rows="5">{{ old('description', $campaign->description) }}</textarea>
    </div>

    <div class="grid-two">

        <div class="field">
            <label>Funding Goal (RM)</label>
            <input type="number"
                   name="funding_goal"
                   min="1"
                   step="0.01"
                   value="{{ old('funding_goal', $campaign->funding_goal) }}"
                   required>
        </div>

        <div class="field">
            <label>Target Beneficiaries</label>
            <input type="number"
                   name="target_beneficiaries"
                   min="0"
                   value="{{ old('target_beneficiaries', $campaign->target_beneficiaries) }}">
        </div>

    </div>

    <div class="grid-two">

        <div class="field">
            <label>Start Date</label>
            <input type="date"
                   name="start_date"
                   value="{{ old('start_date', optional($campaign->start_date)->format('Y-m-d')) }}">
        </div>

        <div class="field">
            <label>End Date</label>
            <input type="date"
                   name="end_date"
                   value="{{ old('end_date', optional($campaign->end_date)->format('Y-m-d')) }}">
        </div>

    </div>

    @if($campaign->review_comment)
        <div class="alert alert-warning">
            <strong>Admin Comment:</strong><br>
            {{ $campaign->review_comment }}
        </div>
    @endif

    <div class="toolbar">
        <button type="submit" class="btn">
            Update & Resubmit
        </button>

        <a href="{{ route('campaigns.index') }}" class="btn-secondary">
            Cancel
        </a>
    </div>

</form>

@endsection