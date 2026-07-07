@php
    $class = match ($status) {
        \App\Models\Complaint::STATUS_WAITING => 'bg-warning-subtle text-warning-emphasis',
        \App\Models\Complaint::STATUS_PROCESS => 'bg-info-subtle text-info-emphasis',
        \App\Models\Complaint::STATUS_DONE => 'bg-success-subtle text-success-emphasis',
        \App\Models\Complaint::STATUS_REJECTED => 'bg-danger-subtle text-danger-emphasis',
        default => 'bg-secondary-subtle text-secondary-emphasis',
    };
@endphp
<span class="status-badge {{ $class }}">{{ $status }}</span>
