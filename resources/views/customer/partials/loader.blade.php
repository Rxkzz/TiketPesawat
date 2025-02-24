<!-- Page Loader -->
<div class="page-loader">
    <div class="loader-content">
        <div class="airplane-loader">
            <img src="{{ asset('images/airplane1.png') }}" alt="Loading...">
            <img src="{{ asset('images/cloud.png') }}" class="cloud cloud-1" alt="Cloud">
            <img src="{{ asset('images/cloud.png') }}" class="cloud cloud-2" alt="Cloud">
            <img src="{{ asset('images/cloud.png') }}" class="cloud cloud-3" alt="Cloud">
        </div>
        <div class="loader-text">Sedang memuat...</div>
    </div>
</div>

<!-- Loader Assets -->
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
<script src="{{ asset('js/loader.js') }}"></script> 