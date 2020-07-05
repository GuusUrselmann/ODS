<div class="sidebar-content">
    <div class="sidebar-return btn">
        <a class="btn btn-outline-primary btn-lg return-btn" href="{{ url('') }}"><i class="fas fa-arrow-left"></i> Terug</a>
    </div>
    <div class="sidebar-logo btn">
        <img src="{{ asset('images/logo/logo.jpg') }}">
    </div>
</div>
<div class="sidebar-footer">
    @include('layouts.auth.footer')
</div>
