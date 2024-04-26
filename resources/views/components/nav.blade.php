<div>
<nav class="nav">
    <div class="nav-logo">
        <a href="{{route('index')}}"><img class="nav-logo--img" src="{{ asset('img/logo_white.png') }}" alt="Logo"></a>
    </div> 
    <div class="mobile-nav">
        <div class="mobile-nav-container">
            <div class="mobile-nav-btn mobile-nav-btn--first"></div>
            <div class="mobile-nav-btn mobile-nav-btn--middle"></div>
            <div class="mobile-nav-btn mobile-nav-btn--last"></div>
        </div>
    </div>
    <div class="nav-list">
        <a class="nav-list--item" href="{{route('index')}}">Dashboard</a>
        <a class="nav-list--item" href="{{ route('allowedCars') }}">Allowed Cars</a>
        <a class="nav-list--item" href="#">Modes</a>
        <a class="nav-list--item" href="#">Profile</a>
        <a class="nav-list--item" href="#">Logout</a>
    </div>
</nav>
<script src="{{asset('js/nav.js')}}"></script>
</div>