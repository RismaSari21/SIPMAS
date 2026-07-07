@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>document.addEventListener('DOMContentLoaded', () => window.showFlash?.('success', @json(session('success'))));</script>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>document.addEventListener('DOMContentLoaded', () => window.showFlash?.('error', @json(session('error'))));</script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali input:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
