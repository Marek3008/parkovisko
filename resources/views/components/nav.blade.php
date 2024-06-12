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
        <a class="nav-list--item" href="{{ route('index') }}">Dashboard</a>
        <a class="nav-list--item" href="{{ route('allowed-cars.index') }}">Allowed Cars</a>
        <a class="nav-list--item" href="{{ route('settings') }}">Settings</a>
        <a class="nav-list--item" href="{{ route('parkingHouses') }}">Parking Houses</a>
        <form action="{{route('logout')}}" class="nav-list--item" method="POST">
            @csrf
            @method('DELETE')
            <a href="#" onclick="this.closest('form').submit();return false;">Logout</a>
        </form>
    </div>
</nav>
<script src="{{asset('js/nav.js')}}"></script>
</div>