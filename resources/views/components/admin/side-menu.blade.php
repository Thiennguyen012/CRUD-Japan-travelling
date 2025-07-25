<div class="admin-menu">
    <div class="menu-block">
        <h3 class="title">サイト管理</h3>
        <ul>
            <li>
                <a class="link" href="{{ route('adminHotelSearchPage') }}">ホテル検索</a>
            </li>
            <li>
                <a class="link" href="{{ route('adminHotelCreatePage') }}">ホテル追加</a>
            </li>
            <li>
                <a class="link" href="{{ route('adminBookingSearchPage') }}">予約情報検索</a>
            </li>
        </ul>
    </div>
</div>

<nav class="mobile-menu">
    <button class="menu-toggle" id="menuToggle">
        Menu
    </button>
    <ul class="menu-list" id="menuList">
        <li><a href="{{ route('adminHotelSearchPage') }}">ホテル検索</a></li>
        <li><a href="{{ route('adminHotelCreatePage') }}">ホテル追加</a></li>
        <li><a href="{{ route('adminBookingSearchPage') }}">予約情報検索</a></li>
    </ul>
</nav>